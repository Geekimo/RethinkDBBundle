<?php

declare(strict_types=1);

use Geekimo\Bundle\RethinkDBBundle\Service\Connection;
use Geekimo\Bundle\RethinkDBBundle\Service\Factory;
use Geekimo\Bundle\RethinkDBBundle\Service\Repository;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\param;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->defaults();

    $services
        ->set(Connection::class)
        ->class(Connection::class)
        ->factory([Factory::class, 'getConnection'])
        ->args([
            '$hostname' => param('rethink_db.hostname'),
            '$port' => param('rethink_db.port'),
            '$database' => param('rethink_db.database'),
            '$apiKey' => param('rethink_db.api_key'),
            '$timeout' => param('rethink_db.timeout'),
        ]);

    $services
        ->set(Repository::class)
        ->class(Repository::class)
        ->arg('$connection', service(Connection::class))
        ->arg('$container', service('service_container'));
};
