<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Offre;
use MainBundle\Form\OffreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class OffreController extends Controller
{
    /**
     * @Route("/send-notification", name="send_notification")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function sendNotificationAction(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');
        $notif->setLink('http://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('Notification subject','Some random text','http://google.fr');

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        $manager->addNotification(array($this->getUser()), $notif, true);

        return $this->redirectToRoute('main_homepage');
    }
    public function AjoutAction(Request $request,$id_etab){
        $Offre=new Offre();
        $Form=$this->createForm(OffreType::class,$Offre);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $etab=$em->getRepository("MainBundle:Etablissement")->find($id_etab);
            $Offre->setEtablissement($etab);
            $em->persist($Offre);
            $em->flush();
            return $this->redirectToRoute('main_homepage');
        }
        return $this->render('MainBundle:Offre:ajout.html.twig',array(
            'form'=>$Form->createView()
        ));

    }

    public function RemoveAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $Offre=$em->getRepository("MainBundle:Offre")->find($id);
        $em->remove($Offre);
        $em->flush();
        return $this->redirectToRoute('main_homepage');
    }

    public function afficheallAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Offre=$em->getRepository("MainBundle:Offre")->findRecent();

        return $this->render('MainBundle:Offre:OffreListe.html.twig',
            array(
                'e'=>$Offre
            ));
    }
    public function afficheAction($id_etab)
    {
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id_etab);
        $Offre=$em->getRepository("MainBundle:Offre")->findRecentEtab($etab);

        return $this->render('MainBundle:Offre:OffreByEtab.html.twig',
            array(
                'e'=>$Offre
            ));
    }
    public function UpdateAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $Offre=$em->getRepository("MainBundle:Offre")->find($id);
        $Form=$this->createForm(OffreType::class,$Offre);
        $Form->handleRequest($request);
        if ($Form->isValid() && $Form->isSubmitted()){
            $em->persist($Offre);
            $em->flush();
            return $this->redirectToRoute('main_homepage');
        }
        return $this->render("MainBundle:Offre:update.html.twig",
            array('form'=>$Form->createView()));

    }
}
