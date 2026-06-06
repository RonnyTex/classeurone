<?php

namespace Application\Usecases\User;

use Domain\User\Roles\Role;
use Domain\User\Roles\RolesRepositoryInterface;

class CreateRoleUsecase {

    public function __construct
    (
        private RolesRepositoryInterface $repo,
    )
    { }

    public function execute(string $roleName)
    {
        $role = new Role($roleName);

        $this->repo->save($role);

        
    }
}