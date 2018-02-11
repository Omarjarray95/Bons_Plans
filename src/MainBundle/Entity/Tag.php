<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MainBundle\Entity\Etablissement;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\TagRepository")
 */
class Tag
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
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\Etablissement",mappedBy="id")
     */
    private $etablissements;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=true)
     */
    private $name;

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
     * Set name
     *
     * @param string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etablissements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add etablissement
     *
     * @param Etablissement $etablissement
     *
     * @return Tag
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
}
