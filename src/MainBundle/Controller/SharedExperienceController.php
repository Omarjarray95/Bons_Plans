<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SharedExperienceController extends Controller
{
    public function AjoutAction()
    {
        return $this->render('MainBundle:SharedExperience:ajout.html.twig', array(
            // ...
        ));
    }

    public function DeleteAction()
    {
        return $this->render('MainBundle:SharedExperience:delete.html.twig', array(
            // ...
        ));
    }

    public function UpdateAction()
    {
        return $this->render('MainBundle:SharedExperience:update.html.twig', array(
            // ...
        ));
    }

    public function AfficheAction()
    {
        return $this->render('MainBundle:SharedExperience:affiche.html.twig', array(
            // ...
        ));
    }

}
