<?php

namespace Geekimo\Bundle\RethinkDBBundle\Entity;

use Geekimo\Bundle\RethinkDBBundle\Service\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ModelBase
{
    protected $connection;

    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
