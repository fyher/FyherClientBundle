<?php

namespace Fyher\ClientBundle\Command;

use Client\Bundle\Entity\Param;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
class InstallCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'fyher_client:install:param';

    protected function configure()
    {
        $this
            ->setDescription('Installation des paramètre RGPD par défaut')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $param=array("retentionRgpd"=>2,"nomDPO"=>null,"prenomDPO"=>null,"societePDO"=>null,"adressePDO"=>null,"cpDPO"=>null,"villeDPO"=>null,
            "telephoneDPO"=>null,"emailDPO"=>null,"statutClient"=>serialize(array(
                array("code"=>"p","couleur"=>"warning","nom"=>"prospect"),
                array("code"=>"a","couleur"=>"success","nom"=>"client"),
                array("code"=>"ac","couleur"=>"info","nom"=>"ancien client")
            )));
        $em=$this->getContainer()->get("doctrine")->getManager();
        $output->writeln("Initialisation des données");
        foreach ($param as $key=>$value){
            $existeparam=$em->getRepository("FyherClientBundle:Param")->findOneBy(array("nomParam"=>$key));
            if(!$existeparam){
                $param=new \Fyher\ClientBundle\Entity\Param();
                $param->setNomParam($key);
                $param->setValueParam($value);
                $em->persist($param);
                $em->flush();
            }else{
                $existeparam->setValueParam($value);
                $em->flush();
            }

        }
        $output->writeln("Insertion réussi");


    }
}
