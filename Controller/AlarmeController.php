<?php

namespace Fyher\ClientBundle\Controller;

use Fyher\ClientBundle\Entity\Alarme;
use Fyher\ClientBundle\Entity\Client;
use Fyher\ClientBundle\Entity\Notes;
use Fyher\ClientBundle\Form\AlarmeType;
use Fyher\ClientBundle\Form\ClientHandler;
use Fyher\ClientBundle\Form\ClientType;
use Fyher\ClientBundle\Form\NoteType;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Alarme controller.
 *
 * @Route("alarme" , name="alarme_")
 */

class AlarmeController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/{email}" , name="liste_alarme")
     */
    public function indexAction(Request $request,$email){

        $listealarme=$this->getDoctrine()->getRepository("FyherClientBundle:Alarme")->findBy(array("emailRappelAlarme"=>$email),array("dateRappelAlarme"=>"DESC"));

        return $this->render("@FyherClient/alarme/index.html.twig",array("liste"=>$listealarme));

    }


    /**
     * @param Request $request
     * @param $hashclient
     * @Route("/listeclient/{hashclient}" , name="liste_client_alarme")
     */
    public function listeclientAction(Request $request,$hashclient){

        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();

        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashclient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }

        $listealarme=$this->getDoctrine()->getRepository("FyherClientBundle:Alarme")->findBy(array("idClient"=>$clientExiste->getId()));

        return $this->render("@FyherClient/alarme/index.html.twig",array("liste"=>$listealarme));
    }


    /**
     * @param Request $request
     * @param $hashclient
     * @Route("/addalarme/{hashclient}" , name="add_alarme", options={"expose"=true})
     */
    public function addAlarmeAction(Request $request,$hashclient){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();

        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashclient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }

        $alarme=new Alarme();
        $form=$this->createForm(AlarmeType::class,$alarme);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($alarme);
            $clientExiste->addIdAlarme($alarme);
            $em->flush();
           // return $this->redirectToRoute("client_client_liste");
            return new JsonReponse(array('message' => 'ok', 200));

        }

        $response = new JsonResponse(
            array(
                'message' => 'success',
                'form' => $this->renderView('@FyherClient/alarme/new.html.twig',
                    array(
                        'form' => $form->createView(),"url"=>$this->generateUrl("alarme_add_alarme",array("hashclient"=>$hashclient))
                    ))), 200);
        return $response;
       // return $this->render("@FyherClient/alarme/new.html.twig",array("form"=>$form->createView()));
    }


    /**
     * @param Request $request
     * @param Alarme $id
     * @Route("/delete/{id}" , name="delete_alarme")
     */
    public function deleteAction(Request $request,Alarme $id){

        $em=$this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();

        return new JsonResponse("200");
    }


    /**
     * @param Request $request
     * @param Alarme $id
     * @Route("/li/{id}" , name="lu_alarme")
     */
    public function luAction(Request $request,Alarme $id){
        $em=$this->getDoctrine()->getManager();
        $id->setLuAlarme(1);
        $id->setDateLuAlarme(new \DateTime());
        $em->flush();

        return new JsonResponse("200");
    }


}