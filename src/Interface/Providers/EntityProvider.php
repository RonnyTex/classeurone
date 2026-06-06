<?php

namespace Interface\Providers;

use Domain\School\Type\TypesRepositoryInterface;
use Domain\User\Roles\RolesRepositoryInterface;
use Infrastructure\Framework\Kernel\ProviderInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Persistance\Json\JsonUsersRepository;
use Domain\User\UsersRepositoryInterface;
use Infrastructure\Persistance\Sql\School\TypesRepository;
use Infrastructure\Persistance\Sql\User\RolesRepository;

class EntityProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(UsersRepositoryInterface::class, fn() => new JsonUsersRepository());
        $c->set(RolesRepositoryInterface::class, fn() => new RolesRepository());
        $c->set(TypesRepositoryInterface::class, fn() => new TypesRepository());
    }

    public function boot(ContainerInterface $c)
    {

    }

}