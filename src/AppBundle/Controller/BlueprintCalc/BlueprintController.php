<?php
namespace AppBundle\Controller\BlueprintCalc;


use AppBundle\Entity\Industryblueprints;
use AppBundle\Entity\Invtypes;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlueprintController extends Controller
{
    /**
     * @Route("/blueprintCalculator", name="blueprint_calculator")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction()
    {
        $blueprints = $this->fetchBlueprints();
        sort($blueprints);
        return $this->render(
            'blueprintCalc/show.html.twig',
            ['blueprints' => $blueprints]
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
            'typeid' => $blueprint->getBlueprinttypeid(),
            'published' => 1
        ]);
        if ($invType instanceof Invtypes) {
            return $invType->getTypename();
        }

        return false;
    }
}