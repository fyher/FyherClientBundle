<?php


namespace  Fyher\ClientBundle\Services;


use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class GestionStatutClientService{

    protected $em;
    protected $container;

    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function decodeStatuts(){
        $infostatut=$this->em->getRepository("FyherClientBundle:Param")->findOneBy(array("nomParam"=>"statutClient"));

        if(!$infostatut){
         return null;
        }

        return unserialize($infostatut->getValueParam());
    }

    public function decodeStatut($codeStaut){

        $infostatut=$this->em->getRepository("FyherClientBundle:Param")->findOneBy(array("nomParam"=>"statutClient"));

        if(!$infostatut){
            return null;
        }
        $infostatutUnserialize=unserialize($infostatut->getValueParam());
        $dataInfo=array();
        foreach($infostatutUnserialize as $infoS){

            if($infoS["code"]==$codeStaut){
                $dataInfo["couleur"]=$infoS["couleur"];
                $dataInfo["nom"]=$infoS["nom"];
                $dataInfo["code"]=$infoS["code"];
                return $dataInfo;
            }
        }
        return $dataInfo;
    }


}