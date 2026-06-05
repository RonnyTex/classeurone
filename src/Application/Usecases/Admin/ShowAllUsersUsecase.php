<?php

namespace Application\Usecases\Admin;

use Domain\User\UsersRepositoryInterface;

class ShowAllUsersUsecase {


    public function __construct(private UsersRepositoryInterface $repo)
    { }

    public function execute(): array
    {
        $users = $this->repo->findAll();
        return $users;
    }
}