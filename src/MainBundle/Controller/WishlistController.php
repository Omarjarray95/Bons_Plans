<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Wishliste;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WishlistController extends Controller
{
    public function AjoutAction($id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id);
        $exist=$em->getRepository("MainBundle:Wishliste")->countWishliste($etab,$user);
        if ($exist==0){
            $Wishlist=new Wishliste();
            $Wishlist->setUser($user);
            $Wishlist->setFavoris($etab);
            $em->persist($Wishlist);
            $em->flush();}

        return $this->render('MainBundle:Etablissement:profile.html.twig',
            array('eta'=>$etab));

    }

    public function RemoveAction($id_etablissement)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository('MainBundle:Etablissement')->find($id_etablissement);
        $Wishlist=$em->getRepository("MainBundle:Wishliste")->findOneBy(array('favoris'=>$etab,'user'=>$user));
        $em->remove($Wishlist);
        $em->flush();
        return $this->render('MainBundle:Etablissement:profile.html.twig',
            array('eta'=>$etab));
    }

    public function AfficheAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $Wishlist=$em->getRepository("MainBundle:Wishliste")->findBy(array('user'=>$user));


        return $this->render('MainBundle:Wishlist:show.html.twig',
            array(
                'w' => $Wishlist
            ));
    }
}
