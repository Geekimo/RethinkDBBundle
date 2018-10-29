<?php

namespace Geekimo\Bundle\RethinkDBBundle\Services;

use Geekimo\Bundle\RethinkDBBundle\Connection;

class RethinkDBFactory
{
    private $instance = null;

    static public function getConnection($parameters) : Connection
    {
        if($this->instance instanceof Connection) {
            return $this->instance;
        } else {
            return $this->instance = new Connection($parameters);
        }
    }
}