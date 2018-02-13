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
            return $this->redirectToRoute('_ajout');
        }
        return $this->render('MainBundle:Reservation:ajout.html.twig', array('Form'=>$Form->createView()));
    }

    public function UpdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository("MainBundle:Reservation")->find($id);
        $Form = $this->createForm(ReservationType::class, $reservation);
        $Form->handleRequest($request);
        if ($Form->isValid()) {
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('_affiche');
        }
        return $this->render('MainBundle:Reservation:update.html.twig', array('form' => $Form->createView()));
    }

    public function DeleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository("MainBundle:Reservation")->find($id);

        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('_affiche');
        return $this->render('MainBundle:Reservation:delete.html.twig', array('Form'=>$Form->createView()));
    }

    public function AfficheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository("ParcBundle:Voiture")->findAll();

        return $this->render("MainBundle:Reservation:affiche.html.twig", array("reservations" => $reservation));

    }

}
