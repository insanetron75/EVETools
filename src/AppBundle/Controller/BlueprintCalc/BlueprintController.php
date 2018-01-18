<?php
namespace AppBundle\Controller\BlueprintCalc;


use AppBundle\Entity\Industryactivitymaterials;
use AppBundle\Entity\Industryblueprints;
use AppBundle\Entity\Invtypes;
use AppBundle\Form\BlueprintForm;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlueprintController extends Controller
{
    /**
     * @Route("/blueprintCalculator", name="blueprint_calculator")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {
        $blueprints = $this->fetchBlueprints();
        sort($blueprints);
        $form        = $this->createForm(BlueprintForm::class, null, ['data' => $blueprints]);
        $params      = $request->request->get('blueprint_form');
        $results     = null;
        $totalVolume = 0;

        if ($params) {
            $results     = $this->getRequestResults($params);
            $totalVolume = $this->calculateTotalVolume($results);
        }

        return $this->render(
            'blueprintCalc/show.html.twig',
            [
                'form'        => $form->createView(),
                'results'     => $results,
                'totalVolume' => $totalVolume
            ]
        );
    }

    /**
     * @return array
     */
    protected function fetchBlueprints()
    {
        $blueprintList = [];
        $objectManager = $this->getDoctrine()->getManager();
        /** @var Industryblueprints[] $industryBlueprints */
        $industryBlueprints = $objectManager->getRepository(Industryblueprints::class)->findAll();
        foreach ($industryBlueprints as $thisBlueprint) {
            $name = $this->findBlueprintName($thisBlueprint, $objectManager);
            if ($name) {
                $blueprintList[] = $this->findBlueprintName($thisBlueprint, $objectManager);
            }
        }

        return $blueprintList;
    }

    /**
     * @param Industryblueprints $blueprint
     * @param ObjectManager      $objectManager
     *
     * @return string|bool
     */
    protected function findBlueprintName(Industryblueprints $blueprint, ObjectManager $objectManager)
    {
        /** @var Invtypes $invType */
        $invType = $objectManager->getRepository(Invtypes::class)->findOneBy([
            'typeid'    => $blueprint->getBlueprinttypeid(),
            'published' => 1
        ]);
        if ($invType instanceof Invtypes) {
            return $invType->getTypename();
        }

        return false;
    }

    protected function getRequestResults(array $params)
    {
        $objectManger = $this->getDoctrine()->getManager();
        /** @var Invtypes $type */
        $type = $objectManger->getRepository(Invtypes::class)->findOneBy(
            ['typename' => $params['blueprint_name']]
        );

        /** @var Industryactivitymaterials[] $materials */
        $materials = $objectManger->getRepository(Industryactivitymaterials::class)->findBy(
            [
                'blueprinttypeid' => $type->getTypeid(),
                'activityid'      => 1 // building
            ]
        );

        $returnMaterials = [];
        foreach ($materials as $thisMaterial) {
            $materialName      = $this->getMaterialName($thisMaterial, $objectManger);
            $quantity          = $thisMaterial->getQuantity() * $params['runs'];
            $weightedQuantity  = $this->getWeightedQuantity($quantity, $params);
            $volume            = $this->getMaterialVolume($thisMaterial, $weightedQuantity);
            $returnMaterials[] = [
                'name'      => $materialName,
                'quantity'  => number_format($weightedQuantity),
                'volume'    => number_format($volume, 2),
                'volumeInt' => $volume
            ];
        }

        return $returnMaterials;
    }

    protected function getMaterialName(Industryactivitymaterials $material, ObjectManager $objectManager)
    {
        /** @var Invtypes $type */
        $type = $objectManager->getRepository(Invtypes::class)->findOneBy(
            ['typeid' => $material->getMaterialtypeid()]
        );

        return $type->getTypename();
    }

    /**
     * @param int   $quantity
     * @param array $params
     *
     * @return int
     */
    protected function getWeightedQuantity($quantity, array $params)
    {
        $blueprintMaterialEfficiency = 1 - ($params['material_efficiency'] / 100);
        $totalQuantity               = $quantity * $blueprintMaterialEfficiency;

        return ceil($totalQuantity * $params['runs']);
    }

    protected function getMaterialVolume(Industryactivitymaterials $material, $quantity)
    {
        $volume = 0;

        $invType = $this->getDoctrine()->getManager()->getRepository(Invtypes::class)->findOneBy(
            [
                'typeid' => $material->getMaterialtypeid()
            ]
        );

        if ($invType instanceof Invtypes) {
            $volume = round($invType->getVolume() * $quantity, 2, PHP_ROUND_HALF_UP);
        }

        return $volume;
    }

    protected function calculateTotalVolume(array $materials)
    {
        $totalVolume = 0;
        foreach ($materials as $thisMaterial) {
            $totalVolume += $thisMaterial['volumeInt'];
        }

        return number_format($totalVolume, 2);
    }
}