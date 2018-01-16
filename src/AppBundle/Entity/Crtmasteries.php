<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Crtmasteries
 *
 * @ORM\Table(name="crtmasteries", indexes={@ORM\Index(name="IDX_crtMasteries_TID", columns={"typeID"})})
 * @ORM\Entity
 */
class Crtmasteries
{
    /**
     * @var integer
     *
     * @ORM\Column(name="typeID", type="integer", nullable=true)
     */
    private $typeid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="masteryLevel", type="boolean", nullable=true)
     */
    private $masterylevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="masteryRecommendedTypeID", type="integer", nullable=true)
     */
    private $masteryrecommendedtypeid;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

