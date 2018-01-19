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
    // 1% bonus
    const INDUSTRIAL_COMPLEX_MODIFIER = 0.99;

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
        $totalVolumeMin = 0;
        $totalVolumeComp = 0;

        if ($params) {
            $results     = $this->getRequestResults($params);
            $totalVolumeMin = $this->calculateTotalVolume($results['minerals']);
            $totalVolumeComp = $this->calculateTotalVolume($results['components']);
        }

        return $this->render(
            'blueprintCalc/show.html.twig',
            [
                'form'        => $form->createView(),
                'results'     => $results,
                'totalVolumeMin' => $totalVolumeMin,
                'totalVolumeComp' => $totalVolumeComp
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
        $materials    = $this->getBlueprintMaterials($params['blueprint_name'], $objectManger);
        $minerals     = [];
        $components   = [];

        /** @var Industryactivitymaterials $thisMaterial */
        foreach ($materials as $thisMaterial) {
            $materialName     = $this->getMaterialName($thisMaterial, $objectManger);
            $quantity         = $thisMaterial->getQuantity() * $params['runs'];
            $weightedQuantity = $this->getWeightedQuantity($quantity, $params);
            $volume           = $this->getMaterialVolume($thisMaterial, $weightedQuantity);
            if (strpos($materialName, 'Capital') !== false || strpos($materialName, 'Structure') !== false) {
                $minerals   = $this->addSubMaterials($thisMaterial, $minerals, $params, $objectManger);
                $components = $this->addMaterialToArray(
                    $materialName,
                    $weightedQuantity,
                    $volume,
                    $components
                );
            } else {
                $minerals = $this->addMaterialToArray(
                    $materialName,
                    $weightedQuantity,
                    $volume,
                    $minerals
                );
            }
        }
        $minerals = $this->addNumberStrings($minerals);
        if (!empty($components)) {
            $components = $this->addNumberStrings($components);
        }

        return ['minerals' => $minerals, 'components' => $components];
    }

    /**
     * @param string        $blueprintName
     * @param ObjectManager $objectManager
     *
     * @return Industryactivitymaterials[]
     */
    protected function getBlueprintMaterials($blueprintName, ObjectManager $objectManager)
    {
        /** @var Invtypes $type */
        $type = $objectManager->getRepository(Invtypes::class)->findOneBy(
            ['typename' => $blueprintName]
        );

        return $objectManager->getRepository(Industryactivitymaterials::class)->findBy(
            [
                'blueprinttypeid' => $type->getTypeid(),
                'activityid'      => 1 // building
            ]
        );
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
        if (isset($params['industrial_complex'])) {
            $totalQuantity = $this->applyComplexBonus($params, $totalQuantity);
        }

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

    protected function addMaterialToArray(
        $materialName,
        $quantity,
        $volume,
        array $returnMaterials
    ) {
        if (key_exists($materialName, $returnMaterials)) {
            $returnMaterials[$materialName]['quantityFloat'] += $quantity;
            $returnMaterials[$materialName]['volumeInt'] += $volume;

            return $returnMaterials;
        } else {
            $returnMaterials[$materialName] = [
                'name'        => $materialName,
                'quantityFloat' => $quantity,
                'volumeInt'   => $volume
            ];

            return $returnMaterials;
        }
    }

    protected function addSubMaterials(
        Industryactivitymaterials $component,
        array $minerals,
        array $params,
        ObjectManager $objectManager
    ) {
        $blueprintName = $this->getMaterialName($component, $objectManager);
        $blueprintName = "$blueprintName Blueprint";

        $materials     = $this->getBlueprintMaterials($blueprintName, $objectManager);
        /** @var Industryactivitymaterials $thisMaterial */
        foreach ($materials as $thisMaterial) {
            $materialName     = $this->getMaterialName($thisMaterial, $objectManager);
            $quantity         = $thisMaterial->getQuantity();
            $weightedQuantity = $this->getWeightedQuantity($quantity, $params);
            $volume           = $this->getMaterialVolume($thisMaterial, $weightedQuantity);
            $minerals         = $this->addMaterialToArray($materialName, $weightedQuantity, $volume, $minerals);
        }

        return $minerals;
    }

    protected function addNumberStrings(array $materials)
    {
        foreach ($materials as $name => $thisMaterial) {
            $materials[$name]['quantity'] = number_format($thisMaterial['quantityFloat']);
            $materials[$name]['volume']   = number_format($thisMaterial['volumeInt'], 2);
        }

        return $materials;
    }

    protected function applyComplexBonus(array $params, $quantity)
    {
        $securityStatus = $params['security_status'];
        $bonus = 0;
        if (isset($params['t1_rig']) && !isset($params['t2_rig'])) {
            $bonus = 2;
            if ($securityStatus === 'low_sec'){
                $bonus = 3.8;
            } elseif ($securityStatus === 'null') {
                $bonus = 4.2;
            }
        } elseif (isset($params['t2_rig'])) {
            $bonus = 2.4;
            if ($securityStatus === 'low_sec'){
                $bonus = 4.56;
            } elseif ($securityStatus === 'null') {
                $bonus = 5.04;
            }
        }

        // Apply the industrial complex base bonus then add the rig bonus
        $quantity = $quantity * self::INDUSTRIAL_COMPLEX_MODIFIER;
        $quantity = $quantity * (1 - ($bonus / 100));
        return $quantity;
    }
}