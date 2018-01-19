<?php
/**
 * Created by PhpStorm.
 * User: Timmy
 * Date: 19/01/2018
 * Time: 01:22
 */

namespace AppBundle\Controller\OreChart;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OreChartController extends Controller
{
    /**
     * @Route("/oreChart", name="ore_chart")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction()
    {
        return $this->render(
            'oreChart/show.html.twig'
        );
    }
}