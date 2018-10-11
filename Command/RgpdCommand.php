<?php

namespace Fyher\ClientBundle\Command;

use Fyher\ClientBundle\Entity\TraitementRgpd;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
class RgpdCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'fyher_client:rgpd:check';

    protected function configure()
    {
        $this
            ->setDescription('Remplace les données qui ne sont plus à garder des xxx dans la base de donnée selon le nombre de mois de retention')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em=$this->getContainer()->get("doctrine")->getManager();

        $retention=$em->getRepository("FyherClientBundle:Param")->findOneBy(array("nomParam"=>"retentionRGPD"));

        if(!$retention){
            $output->writeln("Vous devez executer la commande fyher_client:install:param");
        }else{
            $output->writeln("Durée de retention =>".$retention->getValueParam()." Mois");

            $dateLimiteRetention=new \DateTime();
            $dateLimiteRetention->modify("-".$retention->getValueParam()." months");
            $listeclient=$em->getRepository("FyherClientBundle:Client")->clientRetentionRgpd($dateLimiteRetention);
            $progressBar = new ProgressBar($output, count($listeclient));
            $progressBar->start();
            foreach($listeclient as $listeTraitement){
                $output->writeln("Nom =>".$listeTraitement->getNomClient());
                $listeTraitement->setNomClient("xxxxxxxx");
                $listeTraitement->setPrenomClient("xxxxxxxx");
                $listeTraitement->setAdresseClient("xxxxxxxx");
                $listeTraitement->setVilleClient("xxxxxxx");
                $listeTraitement->setCodePostalClient("xxxxxxx");
                $listeTraitement->setTelephoneMobileClient("0000000000");
                $listeTraitement->setTelephoneFixeClient("0000000000");
                $listeTraitement->setDateUpdateClient(new \DateTime());
                $progressBar->advance();
                $em->flush();
            }

            //on doit créer un traitement pour cette tache
            if($listeclient){
                $output->writeln("Création du rapport de traitement");
                $nbTraitement=$em->getRepository("FyherClientBundle:TraitementRgpd")->findAll();
                $traitement=new TraitementRgpd();
                $traitement->setDate(new \DateTime());
                $progressBar->advance();
                $traitement->setNomResponsableTraitement("Serveur Automatique");
                $traitement->setNumeroActiviteTraitement(count($nbTraitement)+1);
                $traitement->setNomLogicielTraitement("Traitement automatique serveur");
                $traitement->setObjectifTraitement("Anonymat des données dépassant la date de retention RGPD définis dans les CGU");
                $traitement->setCategoriePersonnesTraitement("Personnes sont la date de creation du compte client est extérieur au ".$dateLimiteRetention->format("Y-m-d"));
                $traitement->setCategorieDonneeCollecteeTraitement("identité,adresse,telephone,civilité, date de naissance");
                $traitement->setSensibleDonneeTraitement(false);
                $traitement->setDureeConservationDonneeTraitement($retention->getValueParam()." Mois");
                $traitement->setMesureSecuriteTraitement("Taitement effectué en batch sur un serveur sécurisé");
                $traitement->setDesignationActiviteTraitement("Mise en place de la l'anonymat");
                $em->persist($traitement);
                $em->flush();
            }else{
                $output->writeln("Aucun rapport de traitement à traité");
            }


            $progressBar->finish();
            $output->writeln("Traitement RGPD terminé");

        }



    }
}
