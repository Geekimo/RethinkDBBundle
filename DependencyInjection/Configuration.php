<?php
namespace Geekimo\Bundle\RethinkDBBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('rethinkdb');

        $rootNode
            ->children()
                ->scalarNode('hostname')
                    ->defaultValue('127.0.0.1')
                    ->info('The IP or hostname of the RethinkDB cluster')
                    ->example('127.0.0.1')
                ->end()
                ->scalarNode('port')
                    ->defaultValue(28015)
                    ->info('The port of the RethinkDB cluster')
                    ->example('28015')
                ->end()
                ->scalarNode('database')
                    ->defaultValue(null)
                    ->info('The database for the RethinkDB cluster')
                    ->example('test')
                ->end()
            ->scalarNode('apiKey')
                ->defaultValue(null)
                ->info('The API Key for the RethinkDB cluster')
                ->example('xxxx')
            ->end()
            ->scalarNode('timeout')
                ->defaultValue(null)
                ->info('The timeout to use when connecting to the RethinkDB cluster')
                ->example('30')
            ->end()
            ->end();

        return $treeBuilder;
    }
}
