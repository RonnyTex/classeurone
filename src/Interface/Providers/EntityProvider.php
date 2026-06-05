<?php

namespace Ronos\Interface\Providers;

use Ronos\Infrastructure\Framework\Kernel\ProviderInterface;
use Ronos\Infrastructure\Framework\Container\ContainerInterface;
use Ronos\Infrastructure\Persistance\Json\JsonUsersRepository;
use Ronos\Domain\User\UsersRepositoryInterface;

class EntityProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(UsersRepositoryInterface::class, fn() => new JsonUsersRepository());
    }

    public function boot(ContainerInterface $c)
    {

    }

}