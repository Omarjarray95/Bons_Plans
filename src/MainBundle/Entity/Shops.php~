<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shops
 *
 * @ORM\Table(name="shops")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ShopsRepository")
 */
class Shops extends Etablissement
{
    /**
     * @ORM\Column(name="type_shops", type="string", columnDefinition="enum('Grande surface', 'Parfumerie','Boutique','Patisserie','Librairie','Fleuriste','Candy Shop','Autre')", nullable=TRUE)
     */
    protected $typeShops;

    /**
     * @return mixed
     */
    public function getTypeShops()
    {
        return $this->typeShops;
    }

    /**
     * @param mixed $typeShops
     */
    public function setTypeShops($typeShops)
    {
        $this->typeShops = $typeShops;
    }



    /**
     * Add evaluation
     *
     * @param \MainBundle\Entity\Evaluation $evaluation
     *
     * @return Shops
     */
    public function addEvaluation(\MainBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluation
     *
     * @param \MainBundle\Entity\Evaluation $evaluation
     */
    public function removeEvaluation(\MainBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations->removeElement($evaluation);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     * Add reservation
     *
     * @param \MainBundle\Entity\Reservation $reservation
     *
     * @return Shops
     */
    public function addReservation(\MainBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \MainBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\MainBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
