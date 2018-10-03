<?php
/*
 * This file is part of the MsalsasVotingBundle package.
 *
 * (c) Manolo Salsas
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fyher\ClientBundle\DependencyInjection;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder $builder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fyher_client');

        $rootNode
            ->children()
            ->arrayNode('user')
            ->children()
            ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
            ->end()
            ->end()
            ->arrayNode('token')
            ->children()
            ->scalarNode('map')->isRequired()->cannotBeEmpty()->end()
            ->end() // twitter
            ->end()
        ;

        return $treeBuilder;
    }
}