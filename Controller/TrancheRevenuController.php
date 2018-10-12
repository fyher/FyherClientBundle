<?php

namespace Fyher\ClientBundle\Controller;

use Fyher\ClientBundle\Entity\Alarme;
use Fyher\ClientBundle\Entity\Client;
use Fyher\ClientBundle\Entity\Csp;
use Fyher\ClientBundle\Entity\Notes;
use Fyher\ClientBundle\Entity\Situation;
use Fyher\ClientBundle\Entity\TrancheRevenu;
use Fyher\ClientBundle\Form\AlarmeType;
use Fyher\ClientBundle\Form\ClientHandler;
use Fyher\ClientBundle\Form\ClientType;
use Fyher\ClientBundle\Form\CspType;
use Fyher\ClientBundle\Form\NoteType;
use Fyher\ClientBundle\Form\TrancheRevenuType;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Alarme controller.
 *
 * @Route("trancherevenu" , name="tranchereveun_")
 */

class TrancheRevenuController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/listetranchrevenu/" , name="liste_tranchrevenu")
     */
    public function indexAction(Request $request){

    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/addtrancrevenu", name="add_trancherevenu")
     */
    public function newAction(Request $request){

        $tr=new TrancheRevenu();

        $form=$this->createForm(TrancheRevenuType::class,$tr);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($tr);
            $em->flush();
            // return $this->redirectToRoute("client_client_liste");
            $html="<option value='".$tr->getId()."'>".ucfirst($tr->getNom())."</option>";
            return new JsonResponse(array('message' => 'ok',"idmodify"=>"fyherbundle_client_addd_trancheRevenuClient","html"=>$html,"id"=>$tr->getId(),"value"=>$tr->getNom()));
        }
        $response = new JsonResponse(
            array(
                'message' => 'success',
                'form' => $this->renderView('@FyherClient/trancherevenu//new.html.twig',
                    array(
                        'form' => $form->createView(),"url"=>$this->generateUrl("tranchereveun_add_trancherevenu")
                    ))), 200);
        return $response;
    }

    public function editAction(Request $request,TrancheRevenu $trancheRevenu){

    }

    public function deleteAction(Request $request,TrancheRevenu $trancheRevenu){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();
        $clientwithcsp=$this->getDoctrine()->getRepository(get_class($client))->findBy(array("trancheRevenuCllient"=>$trancheRevenu->getId()));

        if($clientwithcsp){
            $this->addFlash('warning','fyher.action.impossibledeleteliaison');
        }else{
            $this->addFlash('success','fyher.action.supressionsuccess');
            $em=$this->getDoctrine()->getManager();
            $em->remove($trancheRevenu);
            $em->flush();
        }

        return $this->redirectToRoute("situation_liste_situation");


    }

}