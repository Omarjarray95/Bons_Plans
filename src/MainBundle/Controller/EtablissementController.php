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
}
