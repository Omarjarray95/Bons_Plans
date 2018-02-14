<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WishlistController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tasks = $em->getRepository('MainBundle:Task')->findAll();

        return $this->render('task/index.html.twig', array(
            'tasks' => $tasks,
        ));
    }
}
