<?php

namespace Geekimo\Bundle\RethinkDBBundle;

use r;

class Connection {
    private $connection = null;

    public function __construct($parameters)
    {
        $this->connection = r\connect($parameters['hostname'], $parameters['port'], $parameters['database'], $parameters['apiKey'], $parameters['timeout']);
    }

    public function run(r\Query $query, $deepToArray = false)
    {
        $query = $query->run($this->connection);

        if($deepToArray) {
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

    private function deepToArray($value)
    {
        if(is_object($value) && get_class($value) == 'ArrayObject') {
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

class DatabaseConnectionException extends \Exception {}