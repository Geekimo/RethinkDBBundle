<?php
namespace Geekimo\Bundle\RethinkDBBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class RethinkDBBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
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
                    ->scalarNode('api_key')
                    ->defaultValue(null)
                    ->info('The API Key for the RethinkDB cluster')
                    ->example('xxxx')
                ->end()
                ->scalarNode('timeout')
                    ->defaultValue(null)
                    ->info('The timeout to use when connecting to the RethinkDB cluster')
                    ->example('30')
                ->end()
            ->end()
        ;
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->parameters()
            ->set('rethink_db.hostname', $config['hostname'])
            ->set('rethink_db.port', $config['port'])
            ->set('rethink_db.database', $config['database'])
            ->set('rethink_db.api_key', $config['api_key'])
            ->set('rethink_db.timeout', $config['timeout']);

        $container->import('../config/services.php');
    }
}
