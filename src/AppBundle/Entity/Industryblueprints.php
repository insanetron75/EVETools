<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Industryblueprints
 *
 * @ORM\Table(name="industryblueprints")
 * @ORM\Entity
 */
class Industryblueprints
{
    /**
     * @var integer
     *
     * @ORM\Column(name="maxProductionLimit", type="integer", nullable=true)
     */
    private $maxproductionlimit;

    /**
     * @var integer
     *
     * @ORM\Column(name="blueprintTypeID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $blueprinttypeid;

    /**
     * @return int
     */
    public function getMaxproductionlimit()
    {
        return $this->maxproductionlimit;
    }

    /**
     * @param int $maxproductionlimit
     */
    public function setMaxproductionlimit($maxproductionlimit)
    {
        $this->maxproductionlimit = $maxproductionlimit;
    }

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


}

