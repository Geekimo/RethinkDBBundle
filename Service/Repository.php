<?php

namespace Geekimo\Bundle\RethinkDBBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Geekimo\Bundle\RethinkDBBundle\Exception\RepositoryErrorException;
use Geekimo\Bundle\RethinkDBBundle\ModelBase;
use Geekimo\Bundle\RethinkDBBundle\Service\Connection;

class Repository
{
    private $connection;
    private $container;

    public function __construct(Connection $connection, ContainerInterface $container)
    {
        $this->connection = $connection;
        $this->container  = $container;
    }

    public function get(string $model) {
        $model = new $model;

        if(!($model instanceof ModelBase)) {
            throw new RepositoryErrorException(sprintf('Model "%s" must extend "%s"', get_class($model), ModelBase::class));
        }

        // some DI
        $model->setConnection($this->connection);
        $model->setContainer($this->container);

        return $model;
    }
}