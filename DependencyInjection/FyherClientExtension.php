<?php

namespace Fyher\ClientBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
class FyherClientExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('command.xml');
        $config = $this->processConfiguration(new Configuration(), $configs);
        //var_dump($config);
        $container->setParameter('fyher_client.user_class', $config['user']["class"]);
        $container->setParameter('fyher_client.token_map', $config['token']["map"]);
      /*  $container->setParameter('msalsas_voting.anonymous_percent_allowed', $config['anonymous_percent_allowed']);
        $container->setParameter('msalsas_voting.anonymous_min_allowed', $config['anonymous_min_allowed']);*/
    }
    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);
        $doctrineConfig = [];
       // $doctrineConfig['orm']['resolve_target_entities']['Msalsas\VotingBundle\Entity\Vote\UserInterface'] = $config['user_provider'];
        $doctrineConfig['orm']['mappings'][] = array(
            'name' => 'FyherClientBundle',
            'is_bundle' => true,
            'type' => 'annotation',
            'dir'=>'/Entity',
            'prefix' => 'Fyher\ClientBundle\Entity'
        );
        $container->prependExtensionConfig('doctrine', $doctrineConfig);
        //var_dump("ici");
        $twigConfig = [];
       //$twigConfig['globals']['msalsas_voting_voter'] = "@msalsas_voting.voter";
       // $twigConfig['globals']['msalsas_voting_clicker'] = "@msalsas_voting.clicker";
        //$twigConfig['paths'][__DIR__ . '/../Templates'] = "msalsas_voting";
       // $twigConfig['paths'][__DIR__ . '/../Resources/public'] = "msalsas_voting.public";
        $container->prependExtensionConfig('twig', $twigConfig);
    }
    public function getAlias()
    {
        return 'fyher_client';
    }
}