<?php

namespace Fyher\ClientBundle\Services;


use Doctrine\ORM\EntityManager;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Yaml;
class Geoloc
{

    protected $em;
    protected $container;
    protected $token;

    public function __construct(EntityManagerInterface $em, ContainerInterface $container,$token)
    {
        $this->em = $em;
        $this->container = $container;
        $this->token=$token;
    }
    public function ville($adresse){
        $token=$this->token;
        $ch = curl_init();
        // set url
        //https://api.mapbox.com/geocoding/v5/mapbox.places/manche.json?access_token=pk.eyJ1IjoiZnloZXIiLCJhIjoiY2pmODlqMGFjMXJnNjJ4bzQydzc2b2lnaiJ9.blV0-j7Yt73l45IDZUuB1Q
        curl_setopt($ch, CURLOPT_URL, "https://api.mapbox.com/geocoding/v5/mapbox.places/".urlencode($adresse." france").".json?access_token=".$token);
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $output contains the output string
        $output = curl_exec($ch);
        // close curl resource to free up system resources
        curl_close($ch);
        $res=json_decode($output);



        //dump($res->features);

        return $res->features;


    }

    public function geoloc($adresse){
        $token=$this->token;
        $ch = curl_init();
        // set url
        //https://api.mapbox.com/geocoding/v5/mapbox.places/manche.json?access_token=pk.eyJ1IjoiZnloZXIiLCJhIjoiY2pmODlqMGFjMXJnNjJ4bzQydzc2b2lnaiJ9.blV0-j7Yt73l45IDZUuB1Q
        curl_setopt($ch, CURLOPT_URL, "https://api.mapbox.com/geocoding/v5/mapbox.places/".urlencode($adresse).".json?access_token=".$token);
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $output contains the output string
        $output = curl_exec($ch);
        // close curl resource to free up system resources
        curl_close($ch);
        $res=json_decode($output);



        $geo=@$res->features[0]->center;

        //dump($res->features[0]);
        $data=array();
        $data["latitude"]=@$geo[0];
        $data["longitude"]=@$geo[1];
        $list=$res->features[0]->context;
        //dump($list);

        $data["codepostal"]=@$list[0]->text;

        $data["ville"]=@$list[1]->text;
        $data["region"]=@$list[2]->text;
        //dump($data);

        return $data;
    }


}