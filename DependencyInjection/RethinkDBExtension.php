<?php

namespace Geekimo\Bundle\RethinkDBBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

use Geekimo\Bundle\RethinkDBBundle\DependencyInjection\Configuration;
use Geekimo\Bundle\RethinkDBBundle\Services\RethinDBFactory;

class RethinkDBExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        $container->setParameter('rethink_db', $config);
    }
}
