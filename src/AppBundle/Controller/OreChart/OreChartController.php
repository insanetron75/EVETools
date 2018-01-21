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
use AppBundle\Form\OreForm;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OreChartController extends Controller
{
    const ORE_PARENT_MARKET_GROUP = 54;
    const MINERAL_GROUP_ID = 18;

    protected $itemPrices = [];
    protected $selectedRegionId;

    /**
     * @Route("/oreChart", name="ore_chart")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request)
    {
        $form          = $this->createForm(OreForm::class);
        $objectManager = $this->getDoctrine()->getManager();
        $ores          = $this->getOres($objectManager);
        $minerals      = $this->getMinerals($objectManager);
        $ores          = $this->addMineralsToOre($ores, $minerals);

        $params = $request->request->get('ore_form');
        $this->setSelectedRegion($params['region_id']);
        $ores = $this->addRawIsk($ores, $objectManager);
        $ores = $this->addRefinedIsk($ores, $objectManager);

        return $this->render(
            'oreChart/show.html.twig',
            [
                'form'     => $form->createView(),
                'ores'     => $ores,
                'minerals' => $minerals,
                'regionId' => $this->selectedRegionId
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

        $minerals = $this->populateMinerals($mineralMarketGroups);

        return $minerals;
    }

    /**
     * @param Invtypes[] $mineralMarketGroups
     *
     * @return array
     */
    protected function populateMinerals(array $mineralMarketGroups)
    {
        $minerals = [];
        foreach ($mineralMarketGroups as $thisType) {
            $minerals[] = [
                'name' => $thisType->getTypename(),
            ];
        }

        return $minerals;
    }

    protected function addMineralsToOre($ores, $minerals)
    {
        foreach ($ores as $name => $ore) {
            foreach ($minerals as $mineral) {
                $ores[$name][$mineral['name']] = $this->getMineralAmountForOre($name, $mineral);
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

    public function addRawIsk($ores, ObjectManager $objectManager)
    {
        foreach ($ores as $name => $ore) {
            /** @var Invtypes $oreType */
            $oreType            = $objectManager->getRepository(Invtypes::class)->findOneBy(
                ['typename' => $name, 'published' => 1]
            );
            $rawIsk             = ($this->getItemPrice($oreType) / $oreType->getVolume());
            $ores[$name]['raw'] = number_format($rawIsk, 2);
        }

        return $ores;
    }

    public function addRefinedIsk($ores, ObjectManager $objectManager)
    {
        foreach ($ores as $name => $minerals) {
            /** @var Invtypes $oreType */
            $oreType                = $objectManager->getRepository(Invtypes::class)->findOneBy(
                ['typename' => $name, 'published' => 1]
            );
            $refinedIsk             = $this->calculateRefinedIsk($minerals, $oreType, $objectManager);
            $ores[$name]['refined'] = number_format($refinedIsk, 2);
        }

        return $ores;
    }

    public function getItemPrice(Invtypes $item)
    {
        if (key_exists($item->getTypeid(), $this->itemPrices)) {
            return $this->itemPrices[$item->getTypeid()];
        }

        $context    = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $url        = "https://api.eve-marketdata.com/api/item_prices2.xml?char_name=demo&type_ids={$item->getTypeid()}&region_ids={$this->selectedRegionId}&buysell=s";
        $xml        = file_get_contents($url, false, $context);
        $data       = simplexml_load_string($xml);
        $priceArray = $data->xpath('/emd[@version="2"]/result/rowset[@name="item_prices"]/row[@buysell="s"]/@price');
        $price      = json_decode($priceArray[0]);

        return $this->itemPrices[$item->getTypeid()] = round($price, 2);
    }

    protected function calculateRefinedIsk(array $minerals, Invtypes $oreType, ObjectManager $objectManager)
    {
        $total = 0;
        foreach ($minerals as $key => $quantity) {
            if ($key === 'name' || $key === 'raw' || $quantity === '') {
                continue;
            }
            /** @var Invtypes $mineralType */
            $mineralType = $objectManager->getRepository(Invtypes::class)->findOneBy(
                ['typename' => $key, 'published' => 1]
            );
            $amountPerM3 = $quantity / $oreType->getPortionsize() / $oreType->getVolume();
            $total += ($this->getItemPrice($mineralType) * $amountPerM3);
        }

        return $total;
    }

    protected function setSelectedRegion($regionId = 10000002)
    {
        $this->selectedRegionId = $regionId;
    }
}