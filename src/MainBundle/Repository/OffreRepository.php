<?php

namespace MainBundle\Repository;

/**
 * OffreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OffreRepository extends \Doctrine\ORM\EntityRepository
{
    public function findRecent(){

        $em = $this->getEntityManager();
        $currentdate = new \DateTime('now');
        $query = $em->createQuery(
            'SELECT e
        FROM MainBundle:Offre e
        WHERE e.dateFin >= :date'
        )->setParameter('date', $currentdate);

        return $query->getResult();
    }
    public function findRecentEtab($idEtab){

        $em = $this->getEntityManager();
        $currentdate = new \DateTime('now');
        $query = $em->createQuery(
            'SELECT e
        FROM MainBundle:Offre e
        WHERE e.dateFin >= :date
        AND e.etablissement = :etab'
        )->setParameter('date', $currentdate)
            ->setParameter('etab', $idEtab);;

        return $query->getResult();
    }
}
