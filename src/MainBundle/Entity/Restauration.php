<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restauration
 *
 * @ORM\Table(name="restauration")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\RestaurationRepository")
 */
class Restauration extends Etablissement
{

    /**
     *
     * @return int
     * @ORM\Column(name="type_resto", type="string", columnDefinition="enum('Restaurant', 'Bar','Cafe','Fast-Food','Autre')")
     */
    private $typeResto;

    /**
     * @return mixed
     */
    public function getTypeResto()
    {
        return $this->typeResto;
    }

    /**
     * @param mixed $typeResto
     */
    public function setTypeResto($typeResto)
    {
        $this->typeResto = $typeResto;
    }

}
