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
class AlarmeCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'fyher_client:alarme:start';

    protected function configure()
    {
        $this
            ->setDescription('On lance les alerte du jour')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {


        $em=$this->getContainer()->get("doctrine")->getManager();

        //on envoi les alertes de la journée
        $listealerte=$em->getRepository("FyherClientBundle:Alarme")->alertedujour();
        $template="@FyherClient\Email\rappelAlarme.html.twig";
        $classclient=$this->getContainer()->getParameter("fyher_client.user_class");
        $client=new $classclient();

        foreach($listealerte as $liste){

            //on regroupe toute les alarmes dans un seul email
            $infoclient=$em->getRepository(get_class($client))->find($liste->getIdClient());
            $body=$liste->getDescriptionAlarme()."<br>Client :".$infoclient->getNom();

            $this->getContainer()->get("fyher.email")->envoiEmail($template,$liste->getEmailRappelAlarme(),"fyher.email.subject.rappelalarme",$body);
        }


    }
}
