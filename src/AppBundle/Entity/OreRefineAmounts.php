<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OreRefineAmounts
 *
 * @ORM\Table(name="ore_refine_amounts")
 * @ORM\Entity
 */
class OreRefineAmounts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="oreTypeId", type="integer", nullable=false)
     */
    private $oretypeid;

    /**
     * @var integer
     *
     * @ORM\Column(name="mineralTypeId", type="integer", nullable=false)
     */
    private $mineraltypeid;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
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
    public function getOreTypeId()
    {
        return $this->oretypeid;
    }

    /**
     * @param int $oretypeid
     */
    public function setOreTypeId($oretypeid)
    {
        $this->oretypeid = $oretypeid;
    }

    /**
     * @return int
     */
    public function getMineralTypeId()
    {
        return $this->mineraltypeid;
    }

    /**
     * @param int $mineraltypeid
     */
    public function setMineralTypeId($mineraltypeid)
    {
        $this->mineraltypeid = $mineraltypeid;
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

