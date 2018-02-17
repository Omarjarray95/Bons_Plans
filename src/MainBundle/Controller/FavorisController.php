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


    public function AjoutAction($id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id);
        $exist=$em->getRepository("MainBundle:Favoris")->countFavoris($etab,$user);
        if($exist==0){
            $Favoris=new Favoris();
            $Favoris->setUser($user);
            $Favoris->setFavoris($etab);
            $em->persist($Favoris);
            $em->flush();
        }
        return $this->redirectToRoute('main_homepage');
        }

    public function RemoveAction($id_etablissement)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $favoris=$em->getRepository("MainBundle:Favoris")->find($id_etablissement);;
        $em->remove($favoris);
        $em->flush();
        return $this->redirectToRoute('main_homepage');
    }

    public function AfficheAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $favoris=$em->getRepository("MainBundle:Favoris")->findBy(array('user'=>$user));


        return $this->render('MainBundle:Favoris:show.html.twig',
            array(
                'f' => $favoris
            ));
    }

}
