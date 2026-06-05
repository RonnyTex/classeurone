<?php

namespace Application\Usecases\Admin;

use Domain\User\UsersRepositoryInterface;
use Domain\User\User;

class ShowUserUsecase {


    public function __construct(private UsersRepositoryInterface $repo)
    { }

    public function execute(string $userId): ?User
    {
        $user = $this->repo->find($userId);
        return $user;
    }
}