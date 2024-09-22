<?php

namespace Geekimo\Bundle\RethinkDBBundle\Service;

use Geekimo\Bundle\RethinkDBBundle\Entity\ModelBase;
use Geekimo\Bundle\RethinkDBBundle\Exception\RepositoryErrorException;
use Symfony\Component\DependencyInjection\ContainerInterface;

final readonly class Repository
{
    public function __construct(
        private Connection $connection,
        private ContainerInterface $container,
    ) {
    }

    public function get(string $model): ModelBase
    {
        $model = new $model;

        if(!($model instanceof ModelBase)) {
            throw new RepositoryErrorException(sprintf(
                'Model "%s" must extend "%s"',
                $model::class,
                ModelBase::class,
            ));
        }

        $model->setConnection($this->connection);
        $model->setContainer($this->container);

        return $model;
    }
}
