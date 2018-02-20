<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Reservation;
use MainBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $reservation = new Reservation();
        $Form = $this->createForm(ReservationType::class,$reservation);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('main_homepage');
        }
        return $this->render('MainBundle:Reservation:ajout.html.twig', array('Form'=>$Form->createView()));
    }

    public function AfficheAction()
    {
        return $this->render('MainBundle:Reservation:affiche.html.twig', array(
            // ...
        ));
    }

    public function DeleteAction()
    {
        return $this->render('MainBundle:Reservation:delete.html.twig', array(
            // ...
        ));
    }

    public function UpdateAction()
    {
        return $this->render('MainBundle:Reservation:update.html.twig', array(
            // ...
        ));
    }

}
