<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Industryactivityproducts
 *
 * @ORM\Table(name="industryactivityproducts", indexes={@ORM\Index(name="IDX_industryActivityProducts_TID_AID", columns={"blueprintTypeID", "activityID"})})
 * @ORM\Entity
 */
class Industryactivityproducts
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
     * @ORM\Column(name="productTypeID", type="integer", nullable=true)
     */
    private $producttypeid;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="probability", type="float", precision=10, scale=0, nullable=true)
     */
    private $probability;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

