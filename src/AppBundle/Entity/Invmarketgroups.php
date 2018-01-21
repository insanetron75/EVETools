<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invmarketgroups
 *
 * @ORM\Table(name="invmarketgroups")
 * @ORM\Entity
 */
class Invmarketgroups
{
    /**
     * @var integer
     *
     * @ORM\Column(name="parentGroupID", type="integer", nullable=true)
     */
    private $parentgroupid;

    /**
     * @var string
     *
     * @ORM\Column(name="marketGroupName", type="string", length=100, nullable=true)
     */
    private $marketgroupname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=3000, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="iconID", type="integer", nullable=true)
     */
    private $iconid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hasTypes", type="boolean", nullable=true)
     */
    private $hastypes;

    /**
     * @var integer
     *
     * @ORM\Column(name="marketGroupID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $marketgroupid;

    /**
     * @return int
     */
    public function getParentgroupid()
    {
        return $this->parentgroupid;
    }

    /**
     * @param int $parentgroupid
     */
    public function setParentgroupid($parentgroupid)
    {
        $this->parentgroupid = $parentgroupid;
    }

    /**
     * @return string
     */
    public function getMarketgroupname()
    {
        return $this->marketgroupname;
    }

    /**
     * @param string $marketgroupname
     */
    public function setMarketgroupname($marketgroupname)
    {
        $this->marketgroupname = $marketgroupname;
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
     * @return bool
     */
    public function isHastypes()
    {
        return $this->hastypes;
    }

    /**
     * @param bool $hastypes
     */
    public function setHastypes($hastypes)
    {
        $this->hastypes = $hastypes;
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


}

