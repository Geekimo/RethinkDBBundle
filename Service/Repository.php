<?php

namespace Geekimo\Bundle\RethinkDBBundle\Service;

use Geekimo\Bundle\RethinkDBBundle\Exception\RepositoryErrorException;
use Geekimo\Bundle\RethinkDBBundle\ModelBase;
use Geekimo\Bundle\RethinkDBBundle\Service\Connection;

class Repository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get(string $model) {
        $model = new $model;

        if(!($model instanceof ModelBase)) {
            throw new RepositoryErrorException(sprintf('Model "%s" must extend "%s"', get_class($model), ModelBase::class));
        }

        $model->setConnection($connection);
        return $model;
    }
}