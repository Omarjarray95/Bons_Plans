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
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\Etablissement",mappedBy="id")
     */
    private $etablissements;


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
}
