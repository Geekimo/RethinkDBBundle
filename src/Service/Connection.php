<?php

namespace Geekimo\Bundle\RethinkDBBundle\Service;

use Geekimo\Bundle\RethinkDBBundle\Exception\QueryException;
use r;

final readonly class Connection {
    private r\Connection $connection;

    public function __construct(
        string $hostname,
        int $port,
        string $database,
        string|null $apiKey = null,
        int $timeout = 30
    ) {
        $this->connection = r\connect(
            $hostname,
            $port,
            $database,
            $apiKey,
            $timeout,
        );
    }

    public function run(r\Query $query, $deepToArray = false): r\Query
    {
        $query = $query->run($this->connection);

        if (is_object($query) && get_class($query) == 'ArrayObject' && $query->offsetExists('errors') && $query->offsetGet('errors') > 0) {
            throw new QueryException($query->offsetGet('first_error'));
        }

        if($deepToArray && !is_null($query)) {
            if(is_array($query)) {
                $query = $this->deepToArray($query);
            } elseif(get_class($query) == 'ArrayObject') {
                $query = $this->deepToArray($query->getArrayCopy());
            } elseif(method_exists($query, 'toArray')) {
                $query = $this->deepToArray($query->toArray());
            }
        }

        return $query;
    }

    private function deepToArray($value): mixed
    {
        if($value instanceof \ArrayObject) {
            $value = $value->getArrayCopy();
            foreach($value as $k => $v) {
                $value[$k] = $this->deepToArray($v);
            }
        } elseif(is_array($value)) {
            foreach($value as $k => $v) {
                $value[$k] = $this->deepToArray($v);
            }
        }

        return $value;
    }
}
