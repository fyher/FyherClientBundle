<?php

namespace Fyher\ClientBundle\Controller;

use Fyher\ClientBundle\Entity\Client;
use Fyher\ClientBundle\Form\ClientHandler;
use Fyher\ClientBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Accroche controller.
 *
 * @Route("client" , name="client_")
 */

class ClientController extends AbstractController
{
    /**
     * Affiche la liste des clients avec un paginator
     *
     * @Route("/", name="client_liste" , methods={"GET"})
     */
    public function index(Request $request)
    {


        $liste=$this->getDoctrine()->getRepository("FyherClientBundle:Client")->findAll();

        return $this->render("@FyherClient/client/index.html.twig",array("pagination"=>$liste));

    }

    /**
     * @param Request $request
     * @Route("/addclient" , name="client_add")
     */
    public function addClientAction(Request $request){


        $client=new \App\Entity\Client();

        $client=new Client();
        $form=$this->createForm(ClientType::class,$client);


        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute("client_client_liste");
        }


        return $this->render("@FyherClient/client/new.html.twig",array("form"=>$form->createView()));
    }


    /**
     * @param Request $request
     * @param Client $id
     * @Route("/editclient/{hashClient}" , name="edit_client")
     */
    public function editClientAction(Request $request,$hashClient){

        $clientExiste=$this->getDoctrine()->getRepository("FyherClientBundle:Client")->findOneBy(array("hashClient"=>$hashClient));

        if(!$hashClient){
            throw $this->createNotFoundException("le client existe pas");
        }

        $form=$this->createForm(ClientType::class,$clientExiste);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("client_client_liste");
        }

        return $this->render("@FyherClient/client/new.html.twig",array("form"=>$form->createView()));

    }


    /**
     * @param Request $request
     * @param $hashClient
     * @Route("/deleteclient/{hashClient}" , name="delete_client")
     */
    public function deleteAction(Request $request,$hashClient){
        $clientExiste=$this->getDoctrine()->getRepository("FyherClientBundle:Client")->findOneBy(array("hashClient"=>$hashClient));

        if(!$hashClient){
            throw $this->createNotFoundException("le client existe pas");
        }

        $this->getDoctrine()->getManager()->remove($clientExiste);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute("client_client_liste");


    }
}
