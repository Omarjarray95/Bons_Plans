<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 10/02/2018
 * Time: 22:34
 */

namespace MainBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use MainBundle\Entity\Etablissement;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $nom;

    /**
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\Etablissement", inversedBy="id")
     * @ORM\JoinTable(name="favoris")
     */
    protected $etablissements_fav;
    /**
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\Etablissement", inversedBy="id")
     * @ORM\JoinTable(name="wishlist")
     */
    protected $etablissements_wish;
    /**
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\Etablissement", inversedBy="id")
     * @ORM\JoinTable(name="visited")
     */
    protected $etablissements_visited;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Evaluation", mappedBy="id_user")
     */
    protected $evaluations;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Reservation", mappedBy="id_user")
     */
    protected $reservations;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add etablissement
     *
     * @param Etablissement $etablissement
     *
     * @return User
     */
    public function addEtablissement(Etablissement $etablissement)
    {
        $this->etablissements[] = $etablissement;

        return $this;
    }

    /**
     * Remove etablissement
     *
     * @param Etablissement $etablissement
     */
    public function removeEtablissement(Etablissement $etablissement)
    {
        $this->etablissements->removeElement($etablissement);
    }

    /**
     * Get etablissements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtablissements()
    {
        return $this->etablissements;
    }

    /**
     * Add evaluation
     *
     * @param \MainBundle\Entity\Evaluation $evaluation
     *
     * @return User
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
     * @return User
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

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}
