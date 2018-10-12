<?php

namespace Fyher\ClientBundle\Controller;

use Fyher\ClientBundle\Entity\Alarme;
use Fyher\ClientBundle\Entity\Client;
use Fyher\ClientBundle\Entity\Csp;
use Fyher\ClientBundle\Entity\Notes;
use Fyher\ClientBundle\Form\AlarmeType;
use Fyher\ClientBundle\Form\ClientHandler;
use Fyher\ClientBundle\Form\ClientType;
use Fyher\ClientBundle\Form\CspType;
use Fyher\ClientBundle\Form\NoteType;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Alarme controller.
 *
 * @Route("csp" , name="csp_")
 */

class CspController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/listecsp/" , name="liste_csp")
     */
    public function indexAction(Request $request){

    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/addcsp", name="add_csp")
     */
    public function newAction(Request $request){

        $csp=new Csp();

        $form=$this->createForm(CspType::class,$csp);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($csp);
            $em->flush();
            // return $this->redirectToRoute("client_client_liste");
            $html="<option value='".$csp->getId()."'>".ucfirst($csp->getNom())."</option>";
            return new JsonResponse(array('message' => 'ok',"idmodify"=>"fyherbundle_client_addd_cspClient","html"=>$html,"id"=>$csp->getId(),"value"=>$csp->getNom()));
        }
        $response = new JsonResponse(
            array(
                'message' => 'success',
                'form' => $this->renderView('@FyherClient/csp/new.html.twig',
                    array(
                        'form' => $form->createView(),"url"=>$this->generateUrl("csp_add_csp")
                    ))), 200);
        return $response;
    }

    public function editAction(Request $request,Csp $idcsp){

    }

    public function deleteAction(Request $request,Csp $idcsp){
        $classclient=$this->container->getParameter("fyher_client.user_class");
        $client=new $classclient();
        $clientwithcsp=$this->getDoctrine()->getRepository(get_class($client))->findBy(array("cspClient"=>$idcsp->getId()));

        if($clientwithcsp){
            $this->addFlash('warning','fyher.action.impossibledeleteliaison');
        }else{
            $this->addFlash('success','fyher.action.supressionsuccess');
            $em=$this->getDoctrine()->getManager();
            $em->remove($idcsp);
            $em->flush();
        }

        return $this->redirectToRoute("csp_liste_csp");


    }

}