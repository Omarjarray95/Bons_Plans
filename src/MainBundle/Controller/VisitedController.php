<?php

namespace MainBundle\Controller;

use MainBundle\Entity\GoingEvent;
use MainBundle\Entity\InterestEvent;
use MainBundle\Entity\Visited;
use MainBundle\Entity\VisitedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitedController extends Controller
{
    public function AjoutVisitedAction($id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id);
        $exist=$em->getRepository("MainBundle:Visited")->countVisited($etab,$user);
        if ($exist==0){
            $visited=new Visited();
            $visited->setUser($user);
            $visited->setFavoris($etab);
            $em->persist($visited);
            $em->flush();}

        return $this->render('MainBundle:Etablissement:profile.html.twig',
            array('eta'=>$etab));
    }

    public function RemoveVisitedAction($id_etablissement)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository('MainBundle:Etablissement')->find($id_etablissement);
        $visited=$em->getRepository("MainBundle:Visited")->findBy(array('etablissement'=>$etab));
        $em->remove($visited);
        $em->flush();
        return $this->render('MainBundle:Etablissement:profile.html.twig',
            array('eta'=>$etab));
    }

    public function AjoutInterestEventAction($id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->find($id);
        $exist=$em->getRepository("MainBundle:InterestEvent")->countInterestEvent($event,$user);
        $exist_going=$em->getRepository("MainBundle:GoingEvent")->countGoingEvent($event,$user);
        if ($exist_going!=0){
            $going=$em->getRepository("MainBundle:GoingEvent")->find($id);
            $em->remove($going);
            $event->setNbrPersonnes($event->getNbrPersonnes()-1);
            $em->flush();
        }
        if($exist==0){
            $interest=new InterestEvent();
            $interest->setUser($user);
            $interest->setEvent($event);
            $event->setInteresses($event->getInteresses()+1);
            $em->persist($interest);
            $em->persist($event);
            $em->flush();}

        return $this->render('MainBundle:Evenement:afficher.html.twig',
            array('e'=>$event));

    }

    public function RemoveInterestedEventAction($id_event)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->find($id_event);
        $exist_interet=$em->getRepository("MainBundle:InterestEvent")->countInterestEvent($event,$user);
        if($exist_interet==1){
        $intrest=$em->getRepository("MainBundle:InterestEvent")->findOneBy(array('event'=>$event,'user'=>$user));
        $em->remove($intrest);
        $event->setInteresses($event->getInteresses()-1);
        $em->persist($event);
        $em->flush();}
        return $this->render('MainBundle:Evenement:afficher.html.twig',
            array('e'=>$event));
    }


    public function AjoutGoingEventAction($id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->find($id);
        $exist=$em->getRepository("MainBundle:GoingEvent")->countGoingEvent($event,$user);
        $exist_interet=$em->getRepository("MainBundle:InterestEvent")->countInterestEvent($event,$user);
        if ($exist_interet==1){
            $interested=$em->getRepository("MainBundle:InterestEvent")->findOneBy(array('event'=>$event,'user'=>$user));
            $em->remove($interested);
            $event->setInteresses($event->getInteresses()-1);
            $em->flush();
        }
        if ($exist==0){
            $visited=new VisitedEvent();
            $visited->setUser($user);
            $visited->setEvent($event);
            $event->setNbrPersonnes($event->getNbrPersonnes()+1);
            $em->persist($visited);
            $em->persist($event);
        $going=new GoingEvent();
        $going->setUser($user);
        $going->setEvent($event);
        $em->persist($going);
        $em->flush();}

        return $this->render('MainBundle:Evenement:afficher.html.twig',
            array('e'=>$event));

    }
    public function RemoveGoingEventAction($id_event)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository("MainBundle:Evenement")->find($id_event);
        $going=$em->getRepository("MainBundle:GoingEvent")->findOneBy(array('event'=>$event,'user'=>$user));
        $visited=$em->getRepository("MainBundle:VisitedEvent")->findOneBy(array('event'=>$event,'user'=>$user));
        $em->remove($going);
        $em->remove($visited);
        $event->setNbrPersonnes($event->getNbrPersonnes()-1);
        $em->persist($event);
        $em->flush();
        return $this->render('MainBundle:Evenement:afficher.html.twig',
            array('e'=>$event));
    }
    public function AfficheVisitedAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $visited=$em->getRepository("MainBundle:Visited")->findBy(array('user'=>$user));
        return $this->render('MainBundle:Visited:Visited.html.twig',
            array(
                'v' => $visited
            ));
    }

    public function AfficheInterestEventAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $interestedEvent=$em->getRepository("MainBundle:InterestEvent")->findBy(array('user'=>$user));

        return $this->render('MainBundle:Visited:Interested.html.twig',
            array(
                'interest'=>$interestedEvent
            ));
    }
    public function AfficheGoingEventAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em=$this->getDoctrine()->getManager();
        $goingEvent=$em->getRepository("MainBundle:GoingEvent")->findBy(array('user'=>$user));

        return $this->render('MainBundle:Visited:Going.html.twig',
            array(
                'going' => $goingEvent
            ));
    }


}
