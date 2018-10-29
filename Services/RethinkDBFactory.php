<?php

namespace Geekimo\Bundle\RethinkDBBundle\Services;

use Geekimo\Bundle\RethinkDBBundle\Connection;

class RethinkDBFactory
{
    static public function getConnection($parameters) : Connection
    {
        return new Connection($parameters);
    }
}