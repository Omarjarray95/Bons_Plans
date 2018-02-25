<?php

namespace MainBundle\Controller;
use MailBundle\Entity\Mail;
use MainBundle\Entity\Wishliste;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Swift_Message;
use Symfony\Component\HttpFoundation\Response;
class WishlistController extends Controller
{
    public function checkWishAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $etabId = $request->get('id');
            $user = $this->getUser();


            $em = $this->getDoctrine()->getManager();
            $etab = $em->getRepository("MainBundle:Etablissement")->find($etabId);
            $favourite = $em->getRepository("MainBundle:Wishliste")->isWished($etab, $user);
            $response = array('alreadyWish' => true);
            if (count($favourite) == 0) {
                $response = array('alreadyWish' => false);
            }


            return new JsonResponse($response);
        }

        return new JsonResponse();
    }
    public function deleteWishAjaxAction(Request $request, $id)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $wish = $em->getRepository("MainBundle:Wishliste")->findOneBy(['user' => $user , 'favoris' => $id]);
        $em->remove($wish);
        $em->flush();

        return $this->redirectToRoute('Afficher_Etablissement_Client', array('id' => $id));
    }
    public function addWishAjaxAction(Request $request, $id)
    {
        $user = $this->getUser();
        $id_user = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $etab = $em->getRepository("MainBundle:Etablissement")->find($id);
        $exist = $em->getRepository("MainBundle:Wishliste")->countWishliste($etab, $user);
        if ($exist == 0) {
            $Wishlist = new Wishliste();
            $Wishlist->setUser($user);
            $Wishlist->setFavoris($etab);
            $em->persist($Wishlist);
            $em->flush();
            $mail = new Mail();
            $mail->setNom($user->getNom());
            $mail->setPrenom("");
            $mail->setTel($user->getPhone());
            $mail->setEmail($user->getEmail());
            $mail->setText("");
            $message = \Swift_Message::newInstance()
                ->setSubject('Inscription à un bon plan')
                ->setFrom('bonsplans.esprit@gmail.com')
                ->setTo($mail->getEmail())
                ->setBody(
                    $this->renderView(
                        'MailBundle:Mail:emailWish.html.twig',
                        array('nom' => $mail->getNom(), 'bonplan'=>$etab->getNom())
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }

        $response = array('alreadyVisited' => true);


        return $this->redirectToRoute('Afficher_Etablissement_Client', array('id' => $id));
    }


    public function AfficheWishAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $wishlist = $em->getRepository("MainBundle:Wishliste")->findBy(array('user' => $user));


        return $this->render('MainBundle:Profile:show_content.html.twig',
            array(
                'wishes' => $wishlist
            ));
    }

    private function transform(Wishliste $wishliste)
    {
        return "True.0";
    }

    public function getWishListAction()
    {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $wishlist = $em->getRepository("MainBundle:Wishliste")->findBy(array('user' => $user));


        return new JsonResponse($this->transform($wishlist));
    }


    public function getWishAction(Request $request)
    {

        return $this->render('@Main/Wishlist/show_whishlist.html.twig', array());
    }
}
