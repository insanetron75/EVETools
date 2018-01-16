<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Industryblueprints
 *
 * @ORM\Table(name="industryblueprints")
 * @ORM\Entity
 */
class Industryblueprints
{
    /**
     * @var integer
     *
     * @ORM\Column(name="maxProductionLimit", type="integer", nullable=true)
     */
    private $maxproductionlimit;

    /**
     * @var integer
     *
     * @ORM\Column(name="blueprintTypeID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $blueprinttypeid;


}

