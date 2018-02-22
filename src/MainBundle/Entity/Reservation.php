<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Etablissement", inversedBy="reservations")
     * @ORM\JoinColumn(name="id_etablissement", referencedColumnName="id")
     */
    private $etablissement;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $nom;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $numtel;

    /**
     * @return string
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * @param string $numtel
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;
    }
    /**
     * @ORM\Column(type="integer")
     */
    private $nbrePersonnes;

    /**
     * @return mixed
     */
    public function getNbrePersonnes()
    {
        return $this->nbrePersonnes;
    }

    /**
     * @param mixed $nbrePersonnes
     */
    public function setNbrePersonnes($nbrePersonnes)
    {
        $this->nbrePersonnes = $nbrePersonnes;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_de_reservation", type="date")
     */
    private $datedereservation;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * @param mixed $etablissement
     */
    public function setEtablissement($etablissement)
    {
        $this->etablissement = $etablissement;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set datedereservation
     *
     * @param \DateTime $datedereservation
     *
     * @return Reservation
     */
    public function setDatedereservation($datedereservation)
    {
        $this->datedereservation = $datedereservation;

        return $this;
    }

    /**
     * Get datedereservation
     *
     * @return \DateTime
     */
    public function getDatedereservation()
    {
        return $this->datedereservation;
    }
}
