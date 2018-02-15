<?php

namespace MainBundle\Controller;

use MainBundle\Form\EtablissementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MainBundle\Entity\Etablissement;

class EtablissementController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $etablissement=new Etablissement();
        $form=$this->createForm(EtablissementType::class,$etablissement);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($etablissement);
            $em->flush();
            return $this->redirectToRoute('main_homepage');
        }

        return $this->render('MainBundle:Etablissement:ajouter.html.twig',
            array('e' => $form->createView()));
    }

    public function ModifAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $etablissement = $em->getRepository("MainBundle:Etablissement")->find($id);
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $em->persist($etablissement);
            $em->flush();
            return $this->redirectToRoute('main_homepage');
        }
        return $this->render('MainBundle:Etablissement:modifier.html.twig',
            array('et' => $form->createView()));
    }

    public function AfficheAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $etablissement=$em->getRepository("MainBundle:Etablissement")->find($id);
        return $this->render('MainBundle:Etablissement:afficher.html.twig',
            array('eta'=>$etablissement));
    }

    public function SuppAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $etablissement=$em->getRepository("MainBundle:Etablissement")->find($id);
        $em->remove($etablissement);
        $em->flush();
        return $this->redirectToRoute('main_homepage', array());
    }
}
