<?php

namespace Geekimo\Bundle\RethinkDBBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

use Geekimo\Bundle\RethinkDBBundle\DependencyInjection\Configuration;

class RethinkDBExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        dump($config);
    }
}
