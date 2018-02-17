<?php

namespace MainBundle\Controller;

use MainBundle\Entity\GoingEvent;
use MainBundle\Entity\Visited;
use MainBundle\Entity\VisitedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VisitedController extends Controller
{
    public function AjoutAction($id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id);
        $visited=new Visited();
        $visited->setUser($user);
        $visited->setFavoris($etab);
        $em->persist($visited);
        $em->flush();

        return $this->redirectToRoute('main_homepage');

    }

    public function RemoveAction($id_etablissement)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $visited=$em->getRepository("MainBundle:Visited")->find($id_etablissement);;
        $em->remove($visited);
        $em->flush();
        return $this->redirectToRoute('main_homepage');
    }


    public function AjoutEventAction($id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->find($id);
        $visited=new VisitedEvent();
        $visited->setUser($user);
        $visited->setEvent($event);
        $em->persist($visited);
        $em->flush();

        return $this->redirectToRoute('main_homepage');

    }

    public function RemoveEventAction($id_event)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $visited=$em->getRepository("MainBundle:VisitedEvent")->find($id_event);;
        $em->remove($visited);
        $em->flush();
        return $this->redirectToRoute('main_homepage');
    }

    public function AjoutGoingAction($id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->find($id);
        $visited=new GoingEvent();
        $visited->setUser($user);
        $visited->setEvent($event);
        $em->persist($visited);
        $em->flush();

        return $this->redirectToRoute('main_homepage');

    }
    public function RemoveGoingAction($id_event)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $visited=$em->getRepository("MainBundle:GoingEvent")->find($id_event);;
        $em->remove($visited);
        $em->flush();
        return $this->redirectToRoute('main_homepage');
    }
    public function AfficheAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $visited=$em->getRepository("MainBundle:Visited")->findBy(array('user'=>$user));
        $visitedEvent=$em->getRepository("MainBundle:VisitedEvent")->findBy(array('user'=>$user));
        $goingEvent=$em->getRepository("MainBundle:GoingEvent")->findBy(array('user'=>$user));

        return $this->render('MainBundle:Visited:show.html.twig',
            array(
                'v' => $visited,'ve' => $visitedEvent,'going' => $goingEvent
            ));
    }

}
