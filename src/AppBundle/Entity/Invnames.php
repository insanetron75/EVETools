<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invnames
 *
 * @ORM\Table(name="invnames")
 * @ORM\Entity
 */
class Invnames
{
    /**
     * @var string
     *
     * @ORM\Column(name="itemName", type="string", length=200, nullable=true)
     */
    private $itemname;

    /**
     * @var integer
     *
     * @ORM\Column(name="itemID", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $itemid;


}

