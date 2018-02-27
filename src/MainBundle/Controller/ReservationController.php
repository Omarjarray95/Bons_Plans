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
        if ($Form->isValid() && $Form->isSubmitted() && $this->captchaverify($request->get('g-recaptcha-response'))){
            $em= $this->getDoctrine()->getManager();
            $etab=$em->getRepository("MainBundle:Etablissement")->find($id1);
            $user=$em->getRepository("MainBundle:User")->find($id2);
            $reservation->setEtablissement($etab);
            $reservation->setUser($user);
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('affiche_reservation');
        }
        if($Form->isSubmitted() &&  $Form->isValid() && !$this->captchaverify($request->get('g-recaptcha-response'))){

            $this->addFlash(
                'error',
                'Captcha Require'
            );
        }
        return $this->render('MainBundle:Reservation:ajout.html.twig', array('Form'=>$Form->createView()));
    }
    function captchaverify($recaptcha){
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret"=>"6LeTXQgUAAAAALExcpzgCxWdnWjJcPDoMfK3oKGi","response"=>$recaptcha));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;
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
        $em->remove($reservation);
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
