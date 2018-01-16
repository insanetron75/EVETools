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


}

