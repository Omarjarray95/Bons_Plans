<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loisirs
 *
 * @ORM\Table(name="loisirs")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\LoisirsRepository")
 */
class Loisirs extends Etablissement
{

    /**
     * * @ORM\Column(name="type_loisirs", type="string", columnDefinition="enum('Cinema', 'Salle de sport','Parc d attraction','Spa','Salon de coiffure','Centre de beaute','Salle de jeux','Autre')", nullable=TRUE)
     */
    protected $typeLoisirs;

    /**
     * @return mixed
     */
    public function getTypeLoisirs()
    {
        return $this->typeLoisirs;
    }

    /**
     * @param mixed $typeLoisirs
     */
    public function setTypeLoisirs($typeLoisirs)
    {
        $this->typeLoisirs = $typeLoisirs;
    }


    /**
     * Add evaluation
     *
     * @param \MainBundle\Entity\Evaluation $evaluation
     *
     * @return Loisirs
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
     * @return Loisirs
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
