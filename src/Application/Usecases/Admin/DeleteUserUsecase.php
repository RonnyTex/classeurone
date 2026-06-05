<?php


namespace Ronos\Application\Usecases\Admin;

use Ronos\Domain\User\UsersRepositoryInterface;
use Ronos\Domain\User\Exceptions\UserNotFoundException;
use Ronos\Application\DTO\User\DeleteUserOutput;


class DeleteUserUsecase {


    public function __construct(private UsersRepositoryInterface $repo)
    { }

    public function execute(string $userId): DeleteUserOutput
    {
        try {
            
            $this->repo->delete($userId);

            return new DeleteUserOutput(true);

        } catch (\Throwable $th) {
            return new DeleteUserOutput(
                success: false,
                errorType: $th,
                errors: [$th->field => $th->getMessage()]
            );
        }
    }
}