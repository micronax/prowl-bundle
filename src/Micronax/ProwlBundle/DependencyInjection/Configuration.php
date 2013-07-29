<?php

namespace Micronax\ProwlBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Fabian Golle <me@fabian-golle.de>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('micronax_prowl');

        $rootNode->children()
                    ->booleanNode('debug')->defaultValue(false)->end()
                    ->scalarNode('provider_key')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('api_key')->isRequired()->cannotBeEmpty()->end()
                    ->scalarNode('app_name')->isRequired()->cannotBeEmpty()->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
