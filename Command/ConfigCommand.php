<?php

namespace Fyher\ClientBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
class ConfigCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'fyher_client:fyher:test';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln($this->getContainer()->getParameter("fyher_client.rgpd.month_retention"));
    }
}
