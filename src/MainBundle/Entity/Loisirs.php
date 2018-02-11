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
     * * @ORM\Column(name="type_loisirs", type="string", columnDefinition="enum('Cinema', 'Salle de sport','Parc d attraction','Spa','Salon de coiffure','Centre de beaute','Salle de jeux','Autre')")
     */
    private $typeLoisirs;

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

}
