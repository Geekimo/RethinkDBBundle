<?php

namespace Geekimo\Bundle\RethinkDBBundle\Entity;

use Geekimo\Bundle\RethinkDBBundle\Service\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class ModelBase
{
    public function __construct(
        protected ContainerInterface $container,
        protected Connection $connection,
    ) {
    }
}
