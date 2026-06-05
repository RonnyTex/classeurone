<?php

namespace Ronos\Application\Usecases\Admin;

use Ronos\Domain\User\UsersRepositoryInterface;

class ShowAllUsersUsecase {


    public function __construct(private UsersRepositoryInterface $repo)
    { }

    public function execute(): array
    {
        $users = $this->repo->findAll();
        return $users;
    }
}