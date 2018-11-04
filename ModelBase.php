<?php

namespace Geekimo\Bundle\RethinkDBBundle;

use Geekimo\Bundle\RethinkDBBundle\Connection;

class ModelBase
{
    protected $protection;
    
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
    }
}