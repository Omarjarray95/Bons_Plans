<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shops
 *
 * @ORM\Table(name="shops")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ShopsRepository")
 */
class Shops
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
     * @ORM\Column(name="type_shops", type="string", columnDefinition="enum('Grande surface', 'Parfumerie','Boutique','Patisserie','Librairie','Fleuriste','Candy Shop','Autre')")
     */
    private $typeShops;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}