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
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Etablissement", inversedBy="reservations")
     * @ORM\JoinColumn(name="id_etablissement", referencedColumnName="id")
     */
    private $id_etablissement;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $nom;

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
    private $date_de_reservation;

    /**
     * @return \DateTime
     */
    public function getDateDeReservation()
    {
        return $this->date_de_reservation;
    }

    /**
     * @param \DateTime $date_de_reservation
     */
    public function setDateDeReservation($date_de_reservation)
    {
        $this->date_de_reservation = $date_de_reservation;
    }

    /**
     * @return mixed
     */
    public function getIdEtablissement()
    {
        return $this->id_etablissement;
    }

    /**
     * @param mixed $id_etablissement
     */
    public function setIdEtablissement($id_etablissement)
    {
        $this->id_etablissement = $id_etablissement;
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
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
}
