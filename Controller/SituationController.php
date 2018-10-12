<?php

namespace Fyher\ClientBundle\Controller;

use Fyher\ClientBundle\Entity\Alarme;
use Fyher\ClientBundle\Entity\Client;
use Fyher\ClientBundle\Entity\Csp;
use Fyher\ClientBundle\Entity\Notes;
use Fyher\ClientBundle\Entity\Situation;
use Fyher\ClientBundle\Form\AlarmeType;
use Fyher\ClientBundle\Form\ClientHandler;
use Fyher\ClientBundle\Form\ClientType;
use Fyher\ClientBundle\Form\CspType;
use Fyher\ClientBundle\Form\NoteType;
use Fyher\ClientBundle\Form\SituationType;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Alarme controller.
 *
 * @Route("situation" , name="situation_")
 */

class SituationController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/listesituation/" , name="liste_situation")
     */
    public function indexAction(Request $request){

    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/addsituation", name="add_situation")
     */
    public function newAction(Request $request){

        $situation=new Situation();

        $form=$this->createForm(SituationType::class,$situation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($situation);
            $em->flush();
            // return $this->redirectToRoute("client_client_liste");
            $html="<option value='".$situation->getId()."'>".ucfirst($situation->getNom())."</option>";
            return new JsonResponse(array('message' => 'ok',"idmodify"=>"fyherbundle_client_addd_situationClient","html"=>$html,"id"=>$situation->getId(),"value"=>$situation->getNom()));
        }
        $response = new JsonResponse(
            array(
                'message' => 'success',
                'form' => $this->renderView('@FyherClient/situation/new.html.twig',
                    array(
                        'form' => $form->createView(),"url"=>$this->generateUrl("situation_add_situation")
                    ))), 200);
        return $response;
    }

    public function editAction(Request $request,Situation $idsituation){

    }

    public function deleteAction(Request $request,Situation $idsituation){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();
        $clientwithcsp=$this->getDoctrine()->getRepository(get_class($client))->findBy(array("situationClient"=>$idsituation->getId()));

        if($clientwithcsp){
            $this->addFlash('warning','fyher.action.impossibledeleteliaison');
        }else{
            $this->addFlash('success','fyher.action.supressionsuccess');
            $em=$this->getDoctrine()->getManager();
            $em->remove($idsituation);
            $em->flush();
        }

        return $this->redirectToRoute("situation_liste_situation");


    }

}