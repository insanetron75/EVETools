<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Industryactivitymaterials
 *
 * @ORM\Table(name="industryactivitymaterials", indexes={@ORM\Index(name="IDX_industryActivityMaterials_TID_AID", columns={"blueprintTypeID", "activityID"})})
 * @ORM\Entity
 */
class Industryactivitymaterials
{
    /**
     * @var integer
     *
     * @ORM\Column(name="blueprintTypeID", type="integer", nullable=true)
     */
    private $blueprinttypeid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activityID", type="boolean", nullable=true)
     */
    private $activityid;

    /**
     * @var integer
     *
     * @ORM\Column(name="materialTypeID", type="integer", nullable=true)
     */
    private $materialtypeid;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

