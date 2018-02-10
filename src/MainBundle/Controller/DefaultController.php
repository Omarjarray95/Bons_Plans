<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }

    public function indexAdminAction()
    {
        return $this->render('MainBundle:Default:indexAdmin.html.twig');
    }
}
