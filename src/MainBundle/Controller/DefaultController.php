<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $etablissement=$em->getRepository("MainBundle:Etablissement")->findAll();
        return $this->render('MainBundle:Default:index.html.twig',
            array('eta'=>$etablissement));
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
