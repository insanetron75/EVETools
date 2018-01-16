<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Industryactivities
 *
 * @ORM\Table(name="industryactivities", indexes={@ORM\Index(name="IDX_industryActivities_AID", columns={"activityID"})})
 * @ORM\Entity
 */
class Industryactivities
{
    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer", nullable=true)
     */
    private $time;

    /**
     * @var integer
     *
     * @ORM\Column(name="blueprintTypeID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $blueprinttypeid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activityID", type="boolean")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $activityid;


}

