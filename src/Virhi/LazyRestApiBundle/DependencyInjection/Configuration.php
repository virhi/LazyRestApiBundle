<?php

namespace Virhi\LazyRestApiBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('virhi_lazy_rest_api');

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
                ->useAttributeAsKey('name')
                ->prototype('array')
                    ->children()
                        ->scalarNode('entity_name')->end()
                        ->scalarNode('create_mode')->defaultValue(false)->end()
                        ->scalarNode('edit_mode')->defaultValue(false)->end()
                        ->scalarNode('delete_mode')->defaultValue(false)->end()
                    ->end()
                ->end()

            /*
            ->prototype('scalar')
            ->defaultValue(array())
            */
            //->addDefaultChildrenIfNoneSet(array())
            ->end();
    }
}
