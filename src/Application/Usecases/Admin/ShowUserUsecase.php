<?php

namespace Ronos\Application\Usecases\Admin;

use Ronos\Domain\User\UsersRepositoryInterface;
use Ronos\Domain\User\User;

class ShowUserUsecase {


    public function __construct(private UsersRepositoryInterface $repo)
    { }

    public function execute(string $userId): ?User
    {
        $user = $this->repo->find($userId);
        return $user;
    }
}