<?php

namespace Fyher\ClientBundle\Controller;

use Fyher\ClientBundle\Entity\Client;
use Fyher\ClientBundle\Entity\Notes;
use Fyher\ClientBundle\Form\ClientHandler;
use Fyher\ClientBundle\Form\ClientType;
use Fyher\ClientBundle\Form\NoteType;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Notes controller.
 *
 * @Route("notes" , name="notes_")
 */

class NotesController extends AbstractController
{



    /**
     * @param Request $request
     * @param $hashclient
     * @Route("/listenotesclient/{hashclient}" , name="liste_notes_client")
     */
    public function listeclientAction(Request $request,$hashclient){

        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();

        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashclient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }

        $listenote=$clientExiste->getIdNoteClient();


        return $this->render("@FyherClient/notes/index.html.twig",array("listeNote"=>$listenote));


    }


    /**
     * @param Request $request
     * @param $idNote
     * @Route("delete/{id}", name="delete_note")
     */
    public function deleteNote(Request $request,Note $id){


        $em=$this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();

        return $this->redirectToRoute("notes_liste_notes");

    }


    /**
     * @param Request $request
     * @param $hashclient
     * @Route("/addnote/{hashclient}" , name="add_note")
     */
    public function addNote(Request $request,$hashclient){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();

        $clientExiste=$this->getDoctrine()->getRepository(get_class($client))->findOneBy(array("hashClient"=>$hashclient));

        if(!$clientExiste){
            throw $this->createNotFoundException("le client existe pas");
        }

        $notes=new Notes();

        $form=$this->createForm(NoteType::class,$notes);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($notes);
            $clientExiste->addIdNoteClient($notes);
            $em->flush();
            return $this->redirectToRoute("client_client_liste");
        }

        return $this->render("@FyherClient/notes/new.html.twig",array("form"=>$form->createView()));
    }

}