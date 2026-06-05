<?php

namespace Interface\Providers;

use Infrastructure\Framework\Kernel\ProviderInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Persistance\Json\JsonUsersRepository;
use Domain\User\UsersRepositoryInterface;

class EntityProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(UsersRepositoryInterface::class, fn() => new JsonUsersRepository());
    }

    public function boot(ContainerInterface $c)
    {

    }

}