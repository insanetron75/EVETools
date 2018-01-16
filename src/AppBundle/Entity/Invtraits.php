<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invtraits
 *
 * @ORM\Table(name="invtraits", indexes={@ORM\Index(name="IDX_invTraits_TID", columns={"typeID"}), @ORM\Index(name="IDX_invTraits_BID", columns={"bonusID"})})
 * @ORM\Entity
 */
class Invtraits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bonusID", type="integer", nullable=true)
     */
    private $bonusid;

    /**
     * @var integer
     *
     * @ORM\Column(name="typeID", type="integer", nullable=true)
     */
    private $typeid;

    /**
     * @var integer
     *
     * @ORM\Column(name="skilltypeID", type="integer", nullable=true)
     */
    private $skilltypeid;

    /**
     * @var float
     *
     * @ORM\Column(name="bonus", type="float", precision=10, scale=0, nullable=true)
     */
    private $bonus;

    /**
     * @var string
     *
     * @ORM\Column(name="bonusText", type="text", nullable=true)
     */
    private $bonustext;

    /**
     * @var integer
     *
     * @ORM\Column(name="importance", type="integer", nullable=true)
     */
    private $importance;

    /**
     * @var integer
     *
     * @ORM\Column(name="nameID", type="integer", nullable=true)
     */
    private $nameid;

    /**
     * @var integer
     *
     * @ORM\Column(name="unitID", type="integer", nullable=true)
     */
    private $unitid;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

