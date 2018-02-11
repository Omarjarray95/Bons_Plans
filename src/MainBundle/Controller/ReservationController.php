<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReservationController extends Controller
{
    public function AjoutAction()
    {
        return $this->render('MainBundle:Reservation:ajout.html.twig', array(
            // ...
        ));
    }

    public function SupprimerAction()
    {
        return $this->render('MainBundle:Reservation:supprimer.html.twig', array(
            // ...
        ));
    }

    public function ModifierAction()
    {
        return $this->render('MainBundle:Reservation:modifier.html.twig', array(
            // ...
        ));
    }

}
