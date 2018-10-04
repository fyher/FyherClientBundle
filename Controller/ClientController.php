<?php

namespace Fyher\ClientBundle\Controller;

use Fyher\ClientBundle\Entity\Client;
use Fyher\ClientBundle\Entity\Source;
use Fyher\ClientBundle\Entity\SourceClient;
use Fyher\ClientBundle\Form\ClientHandler;
use Fyher\ClientBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Client controller.
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

        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();

        $liste=$this->getDoctrine()->getRepository(get_class($client))->findAll();


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $liste, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render("@FyherClient/client/index.html.twig",array("pagination"=>$pagination));

    }

    /**
     * @param Request $request
     * @Route("/addclient" , name="client_add")
     */
    public function addClientAction(Request $request){


        $classclient=$this->container->getParameter("fyher_client.user_class");

        $client=new $classclient();

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

        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();

        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashClient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }

        if(!$clientExiste->getLatitudeClient()){
            $infoadresse= $this->get("fyher.geoloc")->geoloc($clientExiste->getAdresseClient()." ".$clientExiste->getCodePostalClient()." ".$clientExiste->getVilleClient());


            if($infoadresse){
                $infoadr=$infoadresse;
                $clientExiste->setLatitudeClient($infoadr["latitude"]);
                $clientExiste->setLongitudeClient($infoadr["longitude"]);
                $em=$this->getDoctrine()->getManager();
                $em->flush();
            }
        }

        $form=$this->createForm(ClientType::class,$clientExiste);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','fyher.action.modificationsucess');
            return $this->redirectToRoute("client_client_liste");
        }


        $listesource=$this->getDoctrine()->getRepository("FyherClientBundle:SourceClient")->findBy(array("idClient"=>$clientExiste->getId()));

        $referer = $request->headers->get('referer');
        return $this->render("@FyherClient/client/new.html.twig",array("form"=>$form->createView(),"client"=>$clientExiste,
            "referer"=>$referer,"listesource"=>$listesource));

    }

    /**
     * @param Request $request
     * @param $hashclient
     * @Route("/listeaction/{hashclient}" , name="liste_action_client", options={"expose"=true})
     */
    public function listeactionclientAction(Request $request,$hashclient){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();

        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashclient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }

        $listelog=$this->getDoctrine()->getRepository("Gedmo\Loggable\Entity\LogEntry")->findBy(array("objectId"=>$clientExiste->getId(),"objectClass"=>get_class($client)),array("loggedAt"=>"DESC"));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $listelog, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );


        return $this->render("@FyherClient/client/listeaction.html.twig",array("pagination"=>$pagination));
    }


    /**
     * @param Request $request
     * @param $hashClient
     * @Route("/deleteclient/{hashClient}" , name="delete_client")
     */
    public function deleteAction(Request $request,$hashClient){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();

        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashClient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }

        $this->getDoctrine()->getManager()->remove($clientExiste);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute("client_client_liste");


    }

    /**
     * @param Request $request
     * @param $hashClient
     * @param $statut
     * @Route("/activationclient/{hashClient}/{statut}", name="activation_client")
     */
    public function activationClientAction(Request $request,$hashClient,$statut){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();
        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashClient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }
        $clientExiste->setActiveClient($statut);
        $this->getDoctrine()->getManager()->flush();
        $referer = $request->headers->get('referer');
        $this->addFlash('success','fyher.action.modificationsucess');
        return $this->redirect($referer);
    }

    /**
     * @param Request $request
     * @param $hashclient
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/carteclient/{hashclient}" , name="carte_client" , options={"expose"=true})
     */
    public function affichecarteclientAction(Request $request,$hashclient){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();
        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashclient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }
        $tokenMap=$this->container->getParameter("fyher_client.token_map");

        return $this->render("@FyherClient/client/carte.html.twig",array("client"=>$clientExiste,"tokenMap"=>$tokenMap));

    }
}
