<?php

namespace MainBundle\Repository;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{
    public function RechercherTagDQL($id)
    {
        $SQB1 = $this->getEntityManager()->createQueryBuilder();
        $SQB = $SQB1->select('DISTINCT t.id')->from('MainBundle:Etablissement','et')->leftJoin('et.tags','t')
        ->where('et.id=:i')->setParameter('i',$id)->getQuery()->getResult();

        $QB=$this->getEntityManager()->createQueryBuilder();
        $Q = $QB->select(['t'])->from('MainBundle:Tag','t')->where($QB->expr()->notIn('t',':SQB'))->setParameter('SQB',$SQB);

        return $Q->getQuery()->getResult();
    }
}
