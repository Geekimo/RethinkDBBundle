<?php

namespace Geekimo\Bundle\RethinkDBBundle\Entity;

use Geekimo\Bundle\RethinkDBBundle\Service\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class ModelBase
{
    protected ContainerInterface $container;
    protected Connection $connection;

    public function setConnection(Connection $connection): void
    {
        $this->connection = $connection;
    }

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
}
