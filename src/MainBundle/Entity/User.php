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
     * @return mixed
     */
    public function getEtablissements()
    {
        return $this->etablissements;
    }

    /**
     * @param mixed $etablissements
     */
    public function setEtablissements($etablissements)
    {
        $this->etablissements = $etablissements;
    }
    /**
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\Etablissement")
     * @ORM\JoinColumn(name="etablissements",referencedColumnName="id")
     */
    private $etablissements;
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
