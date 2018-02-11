<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FavorisController extends Controller
{
    public function ajoutAction()
    {
        return $this->render('MainBundle:Favoris:ajout.html.twig', array(
            // ...
        ));
    }

    public function SuppAction()
    {
        return $this->render('MainBundle:Favoris:supp.html.twig', array(
            // ...
        ));
    }

    public function afficheAction()
    {
        return $this->render('MainBundle:Favoris:affiche.html.twig', array(
            // ...
        ));
    }

}
