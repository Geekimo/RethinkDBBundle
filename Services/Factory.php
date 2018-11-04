<?php

namespace Geekimo\Bundle\RethinkDBBundle\Services;

use Geekimo\Bundle\RethinkDBBundle\Services\Connection;

class Factory
{
    static public function getConnection($parameters) : Connection
    {
        return new Connection($parameters);
    }
}