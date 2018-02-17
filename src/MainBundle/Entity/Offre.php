<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table(name="offre")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\OffreRepository")
 */
class Offre
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
     * @var string
     *
     * @ORM\Column(name="offre", type="string", length=255)
     */
    private $offre;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;
    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Etablissement")
     * @ORM\JoinColumn(name="id_etablissement",referencedColumnName="id")
     */
    private $etablissement;

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
     * Set offre
     *
     * @param string $offre
     *
     * @return Offre
     */
    public function setOffre($offre)
    {
        $this->offre = $offre;

        return $this;
    }

    /**
     * Get offre
     *
     * @return string
     */
    public function getOffre()
    {
        return $this->offre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Offre
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Offre
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Offre
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set etablissement
     *
     * @param \MainBundle\Entity\Etablissement $etablissement
     *
     * @return Offre
     */
    public function setEtablissement(\MainBundle\Entity\Etablissement $etablissement = null)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \MainBundle\Entity\Etablissement
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }
}
