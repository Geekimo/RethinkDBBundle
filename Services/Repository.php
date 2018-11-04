<?php

namespace Geekimo\Bundle\RethinkDBBundle\Services;

use Geekimo\Bundle\RethinkDBBundle\Connection;
use Geekimo\Bundle\RethinkDBBundle\ModelBase;

class Repository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get(ModelBase $model) {
        $model = new $model;
        $model->setConnection($connection);
        return $model;
    }
}