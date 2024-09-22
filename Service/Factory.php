<?php

namespace Geekimo\Bundle\RethinkDBBundle\Service;

class Factory
{
    static public function getConnection($parameters) : Connection
    {
        return new Connection($parameters);
    }
}
