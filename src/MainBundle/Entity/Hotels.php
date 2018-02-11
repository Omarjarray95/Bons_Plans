<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotels
 *
 * @ORM\Table(name="hotels")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\HotelsRepository")
 */
class Hotels extends Etablissement
{

    /**
     * @var int
     *
     * @ORM\Column(name="nbrStars", type="integer")
     */
    private $nbrStars;



    /**
     * Set nbrStars
     *
     * @param integer $nbrStars
     *
     * @return Hotels
     */
    public function setNbrStars($nbrStars)
    {
        $this->nbrStars = $nbrStars;

        return $this;
    }

    /**
     * Get nbrStars
     *
     * @return int
     */
    public function getNbrStars()
    {
        return $this->nbrStars;
    }
}
