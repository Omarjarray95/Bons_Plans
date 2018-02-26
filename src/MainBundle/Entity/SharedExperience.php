<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SharedExperience
 *
 * @ORM\Table(name="shared_experience")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\SharedExperienceRepository")
 */
class SharedExperience
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
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\User", inversedBy="sharedExperiences")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Etablissement", inversedBy="sharedExperiences")
     * @ORM\JoinColumn(name="id_etablissement", referencedColumnName="id")
     */
    private $etablissement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkInDate", type="date")
     */
    private $checkInDate;

    /**
     * @var string
     *
     * @ORM\Column(name="impression", type="string", length=2500)
     */
    private $impression;


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
     * Set checkInDate
     *
     * @param \DateTime $checkInDate
     *
     * @return SharedExperience
     */
    public function setCheckInDate($checkInDate)
    {
        $this->checkInDate = $checkInDate;

        return $this;
    }

    /**
     * Get checkInDate
     *
     * @return \DateTime
     */
    public function getCheckInDate()
    {
        return $this->checkInDate;
    }

    /**
     * Set impression
     *
     * @param string $impression
     *
     * @return SharedExperience
     */
    public function setImpression($impression)
    {
        $this->impression = $impression;

        return $this;
    }

    /**
     * Get impression
     *
     * @return string
     */
    public function getImpression()
    {
        return $this->impression;
    }
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

}
