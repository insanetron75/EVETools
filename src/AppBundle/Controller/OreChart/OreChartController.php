<?php
/**
 * Created by PhpStorm.
 * User: Timmy
 * Date: 19/01/2018
 * Time: 01:22
 */

namespace AppBundle\Controller\OreChart;

use AppBundle\Entity\Invmarketgroups;
use AppBundle\Entity\Invtypes;
use AppBundle\Entity\OreRefineAmounts;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OreChartController extends Controller
{
    const ORE_PARENT_MARKET_GROUP = 54;
    const MINERAL_GROUP_ID = 18;

    /**
     * @Route("/oreChart", name="ore_chart")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction()
    {
        $objectManager = $this->getDoctrine()->getManager();
        $ores          = $this->getOres($objectManager);
        $minerals      = $this->getMinerals($objectManager);
        $ores          = $this->addMineralsToOre($ores, $minerals);
        $ores          = $this->addRawIsk($ores);
        $ores          = $this->addRefinedIsk($ores);

        return $this->render(
            'oreChart/show.html.twig',
            [
                'ores'     => $ores,
                'minerals' => $minerals
            ]
        );
    }

    protected function getOres(ObjectManager $objectManager)
    {
        $oreMarketGroups = $objectManager->getRepository(Invmarketgroups::class)->findBy([
            'parentgroupid' => self::ORE_PARENT_MARKET_GROUP
        ]);
        $ores            = $this->getOreNames($oreMarketGroups);

        return $ores;
    }

    /**
     * @param Invmarketgroups[] $oreMarketGroups
     *
     * @return array
     */
    protected function getOreNames(array $oreMarketGroups)
    {
        $ores = [];

        foreach ($oreMarketGroups as $thisGroup) {
            $ores[$thisGroup->getMarketgroupname()] = [
                'name' => $thisGroup->getMarketgroupname()
            ];
        }

        return $ores;
    }

    protected function getMinerals(ObjectManager $objectManager)
    {
        $mineralMarketGroups = $objectManager->getRepository(Invtypes::class)->findBy([
            'groupid'   => self::MINERAL_GROUP_ID,
            'published' => 1
        ]);
        $minerals            = $this->getMineralNames($mineralMarketGroups);

        return $minerals;
    }

    /**
     * @param Invtypes[] $mineralMarketGroups
     *
     * @return array
     */
    protected function getMineralNames(array $mineralMarketGroups)
    {
        $minerals = [];
        foreach ($mineralMarketGroups as $thisType) {
            $minerals[] = $thisType->getTypename();
        }

        return $minerals;
    }

    protected function addMineralsToOre($ores, $minerals)
    {
        foreach ($ores as $name => $ore) {
            foreach ($minerals as $mineral) {
                $ores[$name][$mineral] = $this->getMineralAmountForOre($name, $mineral);
            }
        }

        return $ores;
    }

    protected function getMineralAmountForOre($oreName, $mineralName)
    {
        $objectManager = $this->getDoctrine()->getManager();

        /** @var Invtypes $mineralType */
        $mineralType = $objectManager->getRepository(Invtypes::class)->findOneBy(
            ['typename' => $mineralName, 'published' => 1]
        );

        /** @var Invtypes $oreType */
        $oreType = $objectManager->getRepository(Invtypes::class)->findOneBy(
            ['typename' => $oreName, 'published' => 1]
        );

        /** @var OreRefineAmounts $amountObject */
        $amountObject = $objectManager->getRepository(OreRefineAmounts::class)->findOneBy([
            'mineraltypeid' => $mineralType->getTypeid(),
            'oretypeid'     => $oreType->getTypeid()
        ]);

        if ($amountObject instanceof OreRefineAmounts) {
            return $amountObject->getQuantity();
        } else {
            return '';
        }
    }

    public function addRawIsk($ores)
    {
        foreach ($ores as $name => $ore) {
            $ores[$name]['raw'] = 0;
        }

        return $ores;
    }

    public function addRefinedIsk($ores)
    {
        foreach ($ores as $name => $ore) {
            $ores[$name]['refined'] = 0;
        }

        return $ores;
    }
}