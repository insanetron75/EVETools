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

    /**
     * @return int
     */
    public function getBlueprinttypeid()
    {
        return $this->blueprinttypeid;
    }

    /**
     * @param int $blueprinttypeid
     */
    public function setBlueprinttypeid($blueprinttypeid)
    {
        $this->blueprinttypeid = $blueprinttypeid;
    }

    /**
     * @return bool
     */
    public function isActivityid()
    {
        return $this->activityid;
    }

    /**
     * @param bool $activityid
     */
    public function setActivityid($activityid)
    {
        $this->activityid = $activityid;
    }

    /**
     * @return int
     */
    public function getMaterialtypeid()
    {
        return $this->materialtypeid;
    }

    /**
     * @param int $materialtypeid
     */
    public function setMaterialtypeid($materialtypeid)
    {
        $this->materialtypeid = $materialtypeid;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}

