<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Evenement;
use MainBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
    public function AjoutAction(Request $request,$id_etab){
        $event=new Evenement();
        $Form=$this->createForm(EvenementType::class,$event);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $etab=$em->getRepository("MainBundle:Etablissement")->find($id_etab);
            $event->setEtablissement($etab);
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('main_homepage');
        }
        return $this->render('MainBundle:Evenement:ajout.html.twig',array(
            'form'=>$Form->createView()
        ));

    }

    public function RemoveAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('main_homepage');
    }

    public function afficheallAction()
    {
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->findAll();

        return $this->render('MainBundle:Evenement:eventsListe.html.twig',
            array(
                'e'=>$event
            ));
    }
    public function afficheAction($id_etab)
    {
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->findBy(array('etablissement'=>$id_etab));
        /*je vais creer une fonction list by all this week events et je vais la remplacer par findBy */

        return $this->render('MainBundle:Evenement:eventsByEtab.html.twig',
            array(
                'e'=>$event
            ));
    }
    public function UpdateAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
            $event=$em->getRepository("MainBundle:Evenement")->find($id);
        $Form=$this->createForm(EvenementType::class,$event);
        $Form->handleRequest($request);
        if ($Form->isValid() && $Form->isSubmitted()){
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('profile_etablissement_representant');
        }
        return $this->render("MainBundle:Evenement:update.html.twig",
            array('form'=>$Form->createView()));

    }

}
