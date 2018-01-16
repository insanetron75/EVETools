<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invtypes
 *
 * @ORM\Table(name="invtypes", indexes={@ORM\Index(name="IDX_invTypes_GID", columns={"groupID"})})
 * @ORM\Entity
 */
class Invtypes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="groupID", type="integer", nullable=true)
     */
    private $groupid;

    /**
     * @var string
     *
     * @ORM\Column(name="typeName", type="string", length=500, nullable=true)
     */
    private $typename;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="mass", type="float", precision=10, scale=0, nullable=true)
     */
    private $mass;

    /**
     * @var float
     *
     * @ORM\Column(name="volume", type="float", precision=10, scale=0, nullable=true)
     */
    private $volume;

    /**
     * @var float
     *
     * @ORM\Column(name="packagedVolume", type="float", precision=10, scale=0, nullable=true)
     */
    private $packagedvolume;

    /**
     * @var float
     *
     * @ORM\Column(name="capacity", type="float", precision=10, scale=0, nullable=true)
     */
    private $capacity;

    /**
     * @var integer
     *
     * @ORM\Column(name="portionSize", type="integer", nullable=true)
     */
    private $portionsize;

    /**
     * @var integer
     *
     * @ORM\Column(name="factionID", type="integer", nullable=true)
     */
    private $factionid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="raceID", type="boolean", nullable=true)
     */
    private $raceid;

    /**
     * @var float
     *
     * @ORM\Column(name="basePrice", type="float", precision=10, scale=0, nullable=true)
     */
    private $baseprice;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=true)
     */
    private $published;

    /**
     * @var integer
     *
     * @ORM\Column(name="marketGroupID", type="integer", nullable=true)
     */
    private $marketgroupid;

    /**
     * @var integer
     *
     * @ORM\Column(name="graphicID", type="integer", nullable=true)
     */
    private $graphicid;

    /**
     * @var float
     *
     * @ORM\Column(name="radius", type="float", precision=10, scale=0, nullable=true)
     */
    private $radius;

    /**
     * @var integer
     *
     * @ORM\Column(name="iconID", type="integer", nullable=true)
     */
    private $iconid;

    /**
     * @var integer
     *
     * @ORM\Column(name="soundID", type="integer", nullable=true)
     */
    private $soundid;

    /**
     * @var string
     *
     * @ORM\Column(name="sofFactionName", type="string", length=100, nullable=true)
     */
    private $soffactionname;

    /**
     * @var integer
     *
     * @ORM\Column(name="sofMaterialSetID", type="integer", nullable=true)
     */
    private $sofmaterialsetid;

    /**
     * @var integer
     *
     * @ORM\Column(name="typeID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $typeid;


}

