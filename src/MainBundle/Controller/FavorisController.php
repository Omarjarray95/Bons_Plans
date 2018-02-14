<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Favoris;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FavorisController extends Controller
{


    public function AjoutAction( $id_etablissement){

            $user = $this->getUser();
            $id_user = $user.getId();
            $em=$this->getDoctrine()->getManager();
            $etab=$em->getRepository("MainBundleBundle:Etablissement")->find($id_etablissement);
            $Favoris=new Favoris();
            $Favoris->setUser($id_user);
            $Favoris->setFavoris($etab);
            $em->persist($Favoris);
            $em->flush();

            return $this->render('MainBundle:Etablissement:profile.html.twig',array(

            ));

        }

    public function RemoveAction($id_etablissement)
    {
        $user = $this->getUser();
        $id = $user.getId();
        $em=$this->getDoctrine()->getManager();
        $favoris=$em->getRepository("MainBundle:Favoris")->findBy(array('user'=>$id,'favoris'=>$id_etablissement));;
        $em->remove($favoris);
        $em->flush();
        return $this->render('MainBundle:Etablissement:profile.html.twig',array(

        ));
    }

    public function afficheAction()
    {
        $user = $this->getUser();
        $id = $user.getId();
        $em=$this->getDoctrine()->getManager();
        $favoris=$em->getRepository("MainBundle:Favoris")->findBy(array('user'=>$id);

        return $this->render('MainBundle:Profile:show.html.twig',
            array(
                'f'=>$favoris
            ));
    }

}
