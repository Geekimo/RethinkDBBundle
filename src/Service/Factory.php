<?php

namespace Geekimo\Bundle\RethinkDBBundle\Service;

final readonly class Factory
{
    static public function getConnection(
        string $hostname,
        int $port,
        string $database,
        string|null $apiKey = null,
        int $timeout = 30
    ) : Connection {
        return new Connection(
            $hostname,
            $port,
            $database,
            $apiKey,
            $timeout,
        );
    }
}
