<?php

namespace Geekimo\Bundle\RethinkDBBundle\Services;

use Geekimo\Bundle\RethinkDBBundle\Connection;

class Factory
{
    static public function getConnection($parameters) : Connection
    {
        return new Connection($parameters);
    }
}