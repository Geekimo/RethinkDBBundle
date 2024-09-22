<?php

namespace Geekimo\Bundle\RethinkDBBundle\Service;

final readonly class Factory
{
    static public function getConnection($parameters) : Connection
    {
        return new Connection($parameters);
    }
}
