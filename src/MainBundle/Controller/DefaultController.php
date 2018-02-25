<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $etablissement=$em->getRepository("MainBundle:Etablissement")->findAll();
        $etablissementr=$em->getRepository("MainBundle:Etablissement")->findBy(array('type'=>'Resto_Café'));
        $etablissements=$em->getRepository("MainBundle:Etablissement")->findBy(array('type'=>'Shops'));
        $etablissementh=$em->getRepository("MainBundle:Etablissement")->findBy(array('type'=>'hotels'));
        $etablissementa=$em->getRepository("MainBundle:Etablissement")->findBy(array('type'=>'Autres'));
        return $this->render('MainBundle:Default:index.html.twig',
            array('eta'=>$etablissement,'eta1'=>$etablissementr,'eta2'=>$etablissements,'eta3'=>$etablissementh
            ,'eta4'=>$etablissementa));
    }

    public function indexAdminAction()
    {
        return $this->render('baseAdmin.html.twig');
    }

    public function aproposAction()
    {
        return $this->render('MainBundle:Default:APropos.html.twig');
    }

    public function contactAction()
    {
        return $this->render('MainBundle:Default:Contact.html.twig');
    }
}
