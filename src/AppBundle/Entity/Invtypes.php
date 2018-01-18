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

    /**
     * @return int
     */
    public function getGroupid()
    {
        return $this->groupid;
    }

    /**
     * @param int $groupid
     */
    public function setGroupid($groupid)
    {
        $this->groupid = $groupid;
    }

    /**
     * @return string
     */
    public function getTypename()
    {
        return $this->typename;
    }

    /**
     * @param string $typename
     */
    public function setTypename($typename)
    {
        $this->typename = $typename;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * @param float $mass
     */
    public function setMass($mass)
    {
        $this->mass = $mass;
    }

    /**
     * @return float
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param float $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return float
     */
    public function getPackagedvolume()
    {
        return $this->packagedvolume;
    }

    /**
     * @param float $packagedvolume
     */
    public function setPackagedvolume($packagedvolume)
    {
        $this->packagedvolume = $packagedvolume;
    }

    /**
     * @return float
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param float $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    /**
     * @return int
     */
    public function getPortionsize()
    {
        return $this->portionsize;
    }

    /**
     * @param int $portionsize
     */
    public function setPortionsize($portionsize)
    {
        $this->portionsize = $portionsize;
    }

    /**
     * @return int
     */
    public function getFactionid()
    {
        return $this->factionid;
    }

    /**
     * @param int $factionid
     */
    public function setFactionid($factionid)
    {
        $this->factionid = $factionid;
    }

    /**
     * @return bool
     */
    public function isRaceid()
    {
        return $this->raceid;
    }

    /**
     * @param bool $raceid
     */
    public function setRaceid($raceid)
    {
        $this->raceid = $raceid;
    }

    /**
     * @return float
     */
    public function getBaseprice()
    {
        return $this->baseprice;
    }

    /**
     * @param float $baseprice
     */
    public function setBaseprice($baseprice)
    {
        $this->baseprice = $baseprice;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param bool $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return int
     */
    public function getMarketgroupid()
    {
        return $this->marketgroupid;
    }

    /**
     * @param int $marketgroupid
     */
    public function setMarketgroupid($marketgroupid)
    {
        $this->marketgroupid = $marketgroupid;
    }

    /**
     * @return int
     */
    public function getGraphicid()
    {
        return $this->graphicid;
    }

    /**
     * @param int $graphicid
     */
    public function setGraphicid($graphicid)
    {
        $this->graphicid = $graphicid;
    }

    /**
     * @return float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param float $radius
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * @return int
     */
    public function getIconid()
    {
        return $this->iconid;
    }

    /**
     * @param int $iconid
     */
    public function setIconid($iconid)
    {
        $this->iconid = $iconid;
    }

    /**
     * @return int
     */
    public function getSoundid()
    {
        return $this->soundid;
    }

    /**
     * @param int $soundid
     */
    public function setSoundid($soundid)
    {
        $this->soundid = $soundid;
    }

    /**
     * @return string
     */
    public function getSoffactionname()
    {
        return $this->soffactionname;
    }

    /**
     * @param string $soffactionname
     */
    public function setSoffactionname($soffactionname)
    {
        $this->soffactionname = $soffactionname;
    }

    /**
     * @return int
     */
    public function getSofmaterialsetid()
    {
        return $this->sofmaterialsetid;
    }

    /**
     * @param int $sofmaterialsetid
     */
    public function setSofmaterialsetid($sofmaterialsetid)
    {
        $this->sofmaterialsetid = $sofmaterialsetid;
    }

    /**
     * @return int
     */
    public function getTypeid()
    {
        return $this->typeid;
    }

    /**
     * @param int $typeid
     */
    public function setTypeid($typeid)
    {
        $this->typeid = $typeid;
    }


}

