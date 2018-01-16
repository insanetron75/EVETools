<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Industryactivityskills
 *
 * @ORM\Table(name="industryactivityskills", indexes={@ORM\Index(name="IDX_industryActivitySkills_TID_AID", columns={"blueprintTypeID", "activityID"})})
 * @ORM\Entity
 */
class Industryactivityskills
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
     * @ORM\Column(name="skillID", type="integer", nullable=true)
     */
    private $skillid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="level", type="boolean", nullable=true)
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

