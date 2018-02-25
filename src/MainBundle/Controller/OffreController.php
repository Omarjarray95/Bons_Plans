<?php

namespace MainBundle\Controller;

use MainBundle\Entity\Offre;
use MainBundle\Form\OffreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class OffreController extends Controller
{

    public function AjoutAction(Request $request,$id){
        $Offre=new Offre();
        $Form=$this->createForm(OffreType::class,$Offre);
        $Form->handleRequest($request);
        if ($Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $etab=$em->getRepository("MainBundle:Etablissement")->find($id);
            $Offre->setEtablissement($etab);
            $em->persist($Offre);
            $em->flush();
            $id_offre=$Offre->getId();
            return $this->redirectToRoute('profile_offre_user',array('id'=>$id_offre));
        }
        return $this->render('MainBundle:Offre:ajout.html.twig',array(
            'form'=>$Form->createView()
        ));

    }

    public function RemoveAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $Offre=$em->getRepository("MainBundle:Offre")->find($id);
        $id_etab=$em->getRepository("MainBundle:Etablissement")->find($Offre->getEtablissement());
        $em->remove($Offre);
        $em->flush();
        return $this->redirectToRoute('Afficher_Etablissement_Client',array('id'=>$id_etab->getId()));
    }
    public function RemoveAdminAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $offre=$em->getRepository("MainBundle:Offre")->find($id);
        $em->remove($offre);
        $em->flush();
        return $this->redirectToRoute('all_offres_Admin');
    }
    public function AfficheAllAdminAction()
    {
        $em=$this->getDoctrine()->getManager();
        $offres=$em->getRepository("MainBundle:Offre")->findAll();
        return $this->render('MainBundle:Admin:Affiche_Offre.html.twig',
            array('offre'=>$offres));
    }

    public function AfficheAllUserAction()
    {
        $em=$this->getDoctrine()->getManager();
        $offre=$em->getRepository("MainBundle:Offre")->findRecent();
        return $this->render('MainBundle:Offre:Liste.html.twig',
            array(
                'offre'=>$offre
            ));
    }
    public function AfficheOffresAdminIdEtabAction($id_etab)
    {
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id_etab);
        $offre=$em->getRepository("MainBundle:Offre")->findBy(array('etablissement'=>$etab));
        return $this->render('MainBundle:Admin:Affiche_Offre_Id_etab.html.twig',
            array(
                'offre'=>$offre
            ));
    }
    public function AfficheOffresUserIdEtabAction($id_etab)
    {
        $em=$this->getDoctrine()->getManager();
        $etab=$em->getRepository("MainBundle:Etablissement")->find($id_etab);
        $offre=$em->getRepository("MainBundle:Offres")->findBy(array('etablissement'=>$etab));
        return $this->render('MainBundle:Offre:Liste_etab.html.twig',
            array(
                'offre'=>$offre,'etab'=>$etab
            ));
    }
    public function AfficheIdOffreAdminAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $offre=$em->getRepository("MainBundle:Offre")->find($id);
        return $this->render('MainBundle:Admin:Affiche_Offre_Id.html.twig',
            array('offre'=>$offre));
    }

    public function AfficheIdOffreUserAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $offre=$em->getRepository("MainBundle:Offre")->find($id);
        return $this->render('MainBundle:Offre:afficher.html.twig',
            array(
                'offre'=>$offre
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
            return $this->redirectToRoute('profile_offre_user',array('id'=>$id));
        }
        return $this->render("MainBundle:Offre:update.html.twig",
            array('form'=>$Form->createView()));

    }
}
