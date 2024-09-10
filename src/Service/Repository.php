<?php

namespace Geekimo\Bundle\RethinkDBBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Geekimo\Bundle\RethinkDBBundle\Exception\RepositoryErrorException;
use Geekimo\Bundle\RethinkDBBundle\ModelBase;

class Repository
{
    public function __construct(
        private Connection $connection,
        private ContainerInterface $container,
    ) {
    }

    public function get(string $model) {
        $model = new $model;

        if(!($model instanceof ModelBase)) {
            throw new RepositoryErrorException(sprintf(
                'Model "%s" must extend "%s"',
                $model::class,
                ModelBase::class,
            ));
        }

        // some DI
        $model->setConnection($this->connection);
        $model->setContainer($this->container);

        return $model;
    }
}
