<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Reservation;
use MainBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends Controller
{
    public function AjoutAction(Request $request, $id1, $id2)
    {
        $reservation = new Reservation();
        $Form = $this->createForm(ReservationType::class,$reservation);
        $Form->handleRequest($request);
        if ($Form->isValid() && $Form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $etab=$em->getRepository("MainBundle:Etablissement")->find($id1);
            $user=$em->getRepository("MainBundle:User")->find($id2);
            $reservation->setEtablissement($etab);
            $reservation->setUser($user);
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('affiche_reservation');
        }
        return $this->render('MainBundle:Reservation:ajout.html.twig', array('Form'=>$Form->createView()));
    }


    public function AfficheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository("MainBundle:Reservation")->findAll();
        return $this->render('MainBundle:Reservation:affiche.html.twig', array('r' => $reservation));
    }

    public function DeleteAction($id1, $id2)
    {
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository("MainBundle:Reservation")->find($id1);
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id2);
        $etab->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('affiche_reservation');

    }

    public function UpdateAction(Request $request, $id1, $id2)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation=$em->getRepository("MainBundle:Reservation")->find($id1);
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id2);
        $Form = $this->createForm(ReservationType::class, $reservation);
        $Form->handleRequest($request);
        if ($Form->isValid()) {

            $em->persist($reservation);
            $em->persist($etab);
            $em->flush();
            return $this->redirectToRoute('affiche_reservation');
        }
        return $this->render('MainBundle:Reservation:ajout.html.twig', array('Form'=>$Form->createView()));
    }

}
