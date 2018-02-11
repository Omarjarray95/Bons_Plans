<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\Column(name="type_service", type="string", columnDefinition="enum('Wifi', 'Parking','Espace kids','Utilites handicapes','Music','Espace fumeur','autre")")
     */
    private $typeService;

    /**
     * @return mixed
     */
    public function getTypeService()
    {
        return $this->typeService;
    }

    /**
     * @param mixed $typeService
     */
    public function setTypeService($typeService)
    {
        $this->typeService = $typeService;
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
}

