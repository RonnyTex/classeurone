<?php

namespace Application\Usecases\User;

use Domain\User\Roles\RolesRepositoryInterface;

class GetAllRolesUsecase {

    public function __construct(private RolesRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    
    public function execute()
    {
        $roles = $this->repo->all();
        return $roles;
    }

}