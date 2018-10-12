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
 * @Route("ville" , name="ville_")
 */

class VilleController extends AbstractController
{
    /**
     * @param Request $request
     * @param $nomVille
     * @Route("/infoville/{nomVille}" , name="info_ville",options={"expose"=true})
     */
    public function indexAction(Request $request,$nomVille){

        $infoville=$this->get("fyher.geoloc")->ville($nomVille);

       return $this->render("@FyherClient/ville/listing.html.twig",array("liste"=>$infoville));
    }

}