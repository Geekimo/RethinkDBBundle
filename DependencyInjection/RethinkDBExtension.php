<?php

namespace Geekimo\Bundle\RethinkDBBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Geekimo\Bundle\RethinkDBBundle\DependencyInjection\Configuration;

class RethinkDBExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $arguments = array();
        foreach ($config as $key => $value) {
            $key = preg_replace_callback(
                '/_([a-z])/',
                function ($str) {
                    return strtoupper($str[1]);
                },
                $key
            );
            $arguments[$key] = $value;
        }

    }
}
