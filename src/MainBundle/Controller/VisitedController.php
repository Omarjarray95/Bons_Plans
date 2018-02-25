<?php

namespace MainBundle\Controller;

use MainBundle\Entity\GoingEvent;
use MainBundle\Entity\InterestEvent;
use MainBundle\Entity\Visited;
use MainBundle\Entity\VisitedEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VisitedController extends Controller
{

    public function checkVisitedAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $etabId = $request->get('id');
            $user = $this->getUser();


            $em = $this->getDoctrine()->getManager();
            $etab = $em->getRepository("MainBundle:Etablissement")->find($etabId);
            $favourite = $em->getRepository("MainBundle:Visited")->isVisited($etab, $user);
            $response = array('alreadyVisited' => true);
            if (count($favourite) == 0) {
                $response = array('alreadyVisited' => false);
            }


            return new JsonResponse($response);
        }

        return new JsonResponse();
    }


    public function deleteVisitAjaxAction(Request $request, $id)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $visit = $em->getRepository("MainBundle:Visited")->findOneBy(['user' => $user , 'favoris' => $id]);
        $em->remove($visit);
        $em->flush();

        return $this->redirectToRoute('Afficher_Etablissement_Client', array('id' => $id));
    }

    public function addVisitedAjaxAction(Request $request, $id)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $etab = $em->getRepository("MainBundle:Etablissement")->find($id);
        $exist = $em->getRepository("MainBundle:Visited")->countVisited($etab, $user);
        if ($exist == 0) {
            $visited = new Visited();
            $visited->setUser($user);
            $visited->setFavoris($etab);
            $em->persist($visited);
            $em->flush();
        }

        $response = array('alreadyVisited' => true);


        return $this->redirectToRoute('Afficher_Etablissement_Client', array('id' => $id));
    }


    public function RemoveVisitedUserAction($id_etablissement)
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $etab = $em->getRepository('MainBundle:Etablissement')->find($id_etablissement);
        $visited = $em->getRepository("MainBundle:Visited")->findBy(array('etablissement' => $etab));
        $etabs=$em->getRepository('MainBundle:Etablissement')->findAll();
        $em->remove($visited);
        $em->flush();
        return $this->render('MainBundle:Profile:show_content.html.twig',
            array('etabs_visited' => $etabs));
    }


    public function AfficheVisitedAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $visited = $em->getRepository("MainBundle:Visited")->findBy(array('user' => $user));
        return $this->render('MainBundle:Profile:show_content.html.twig',
            array(
                'visited' => $visited
            ));
    }



}
