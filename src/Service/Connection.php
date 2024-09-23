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

    private function throwOnQueryError(mixed $result): void
    {
        if (
            $result instanceof \ArrayObject
            && $result->offsetExists('errors')
            && $result->offsetGet('errors') > 0
        ) {
            throw new QueryException($result->offsetGet('first_error'));
        }
    }

    public function getQueryResultAsArray(r\Query $query): array
    {
        $result = $query->run($this->connection);

        $this->throwOnQueryError($query);

        if(null === $result) {
            return [];
        }

        if(is_array($result)) {
            return $this->deepToArray($result);
        } elseif ($result instanceof \ArrayObject) {
            return $this->deepToArray($result->getArrayCopy());
        } elseif ($result instanceof \Traversable || method_exists($result, 'toArray')) {
            return $this->deepToArray($result->toArray());
        }

        return (array) $result;
    }

    public function runQuery(r\Query $query): mixed
    {
        $result = $query->run($this->connection);

        $this->throwOnQueryError($result);

        return $result;
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
