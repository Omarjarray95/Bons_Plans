<?php

namespace MainBundle\Controller;

use MainBundle\Entity\GoingEvent;
use MainBundle\Entity\VisitedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GoingEventsController extends Controller
{
    public function checkVisitedAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $eventId = $request->get('id');
            $user = $this->getUser();


            $em = $this->getDoctrine()->getManager();
            $event = $em->getRepository("MainBundle:Evenement")->find($eventId);
            $favourite = $em->getRepository("MainBundle:GoingEvent")->isGoing($event, $user);
            $response = array('Going' => true);
            if (count($favourite) == 0) {
                $response = array('Going' => false);
            }


            return new JsonResponse($response);
        }

        return new JsonResponse();
    }


    public function deleteGoingAjaxAction(Request $request, $id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("MainBundle:Evenement")->find($id);
        $going = $em->getRepository("MainBundle:GoingEvent")->findOneBy(array('event' => $event, 'user' => $user));
        $visited = $em->getRepository("MainBundle:VisitedEvent")->findOneBy(array('event' => $event, 'user' => $user));
        $em->remove($going);
        $em->remove($visited);
        $event->setNbrPersonnes($event->getNbrPersonnes() - 1);
        $em->persist($event);
        $em->flush();

        return $this->redirectToRoute('profile_event_user', array('id_event' => $id));
    }

    public function addGoingAjaxAction(Request $request, $id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("MainBundle:Evenement")->find($id);
        $exist = $em->getRepository("MainBundle:GoingEvent")->countGoingEvent($event, $user);
        $exist_interet = $em->getRepository("MainBundle:InterestEvent")->countInterestEvent($event, $user);
        if ($exist_interet == 1) {
            $interested = $em->getRepository("MainBundle:InterestEvent")->findOneBy(array('event' => $event, 'user' => $user));
            $em->remove($interested);
            $event->setInteresses($event->getInteresses() - 1);
            $em->flush();
        }
        if ($exist == 0) {

                $visited = new VisitedEvent();
                $visited->setUser($user);
                $visited->setEvent($event);
                $event->setNbrPersonnes($event->getNbrPersonnes() + 1);
                $em->persist($visited);
                $em->persist($event);

                    $going = new GoingEvent();
                    $going->setUser($user);
                    $going->setEvent($event);
                    $em->persist($going);
                    $em->flush();

        }
        $response = array('Going' => true);


        return $this->redirectToRoute('profile_event_user', array('id_event' => $id));
    }
    public function removeGoingUserAction($id_event){
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository("MainBundle:Evenement")->find($id_event);
        $going = $em->getRepository("MainBundle:GoingEvent")->findOneBy(array('event' => $event, 'user' => $user));
        $visited = $em->getRepository("MainBundle:VisitedEvent")->findOneBy(array('event' => $event, 'user' => $user));
        $em->remove($going);
        $em->remove($visited);
        $event->setNbrPersonnes($event->getNbrPersonnes() - 1);
        $em->persist($event);
        $em->flush();
        $goingEvent = $em->getRepository("MainBundle:GoingEvent")->findBy(array('user' => $user));
        return $this->redirectToRoute('fos_user_profile_show');
    }
    public function AfficheGoingEventAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $goingEvent = $em->getRepository("MainBundle:GoingEvent")->findBy(array('user' => $user));

        return $this->render('MainBundle:Profile:show_content.html.twig',
            array(
                'going' => $goingEvent
            ));
    }
    public function AfficheVisitedEventAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $goingEvent = $em->getRepository("MainBundle:VisitedEvent")->findBy(array('user' => $user));

        return $this->render('MainBundle:Profile:show_content.html.twig',
            array(
                'visited_events' => $goingEvent
            ));
    }
}
