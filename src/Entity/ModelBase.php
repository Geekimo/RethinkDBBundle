<?php

namespace Geekimo\Bundle\RethinkDBBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Geekimo\Bundle\RethinkDBBundle\Service\Connection;

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