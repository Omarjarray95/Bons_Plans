<?php

namespace MainBundle\Repository;
use MainBundle\Entity\User;
/**
 * WishlisteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class WishlisteRepository extends \Doctrine\ORM\EntityRepository
{

    public function isWished($etab, User $user)
    {
        return
            $this->createQueryBuilder('c')
                ->andWhere('c.user = :user')
                ->andWhere('c.favoris = :fav')
                ->setParameter('fav', $etab)
                ->setParameter('user', $user)
                ->getQuery()->getResult();

    }
    public function countWishliste($etabid,$userid){

        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT count(f)
        FROM MainBundle:Wishliste f
        WHERE f.user = :usr
        AND f.favoris = :fav'
        )->setParameter('usr', $userid)
            ->setParameter('fav',$etabid);

        return $query->getSingleScalarResult();
    }
}
