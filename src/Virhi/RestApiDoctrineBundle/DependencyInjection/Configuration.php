<?php

namespace Virhi\RestApiDoctrineBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;


/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('virhi_rest_api_doctrine');

        $rootNode->children()
            ->scalarNode('manager')
            ->end()
        ;

        $this->addRestApiNode($rootNode);

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }

    public function addRestApiNode(ArrayNodeDefinition $rootNode)
    {
        $rootNode->children()
            ->arrayNode('expose_entities')
            ->prototype('scalar')
            ->defaultValue(array())

            //->addDefaultChildrenIfNoneSet(array())
            ->end();
    }
}
