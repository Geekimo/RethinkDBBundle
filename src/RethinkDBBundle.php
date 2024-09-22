<?php
namespace Geekimo\Bundle\RethinkDBBundle;

use Geekimo\Bundle\RethinkDBBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class RethinkDBBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $config = (new Processor())->processConfiguration(new Configuration(), $config);

        $loader = new YamlFileLoader(
            $builder,
            new FileLocator(__DIR__ . '/Resources/config')
        );
        $loader->load('services.yml');

        $builder->setParameter('rethink_db', $config);
    }
}
