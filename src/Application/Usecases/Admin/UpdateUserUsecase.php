<?php


namespace Ronos\Application\Usecases\Admin;

use Ronos\Domain\User\UsersRepositoryInterface;
use Ronos\Domain\User\Exceptions\UserNotFoundException;
use Ronos\Application\DTO\User\UpdateUserOutput;
use Ronos\Domain\User\VO\Email;
use Ronos\Domain\User\VO\Password;
use Ronos\Domain\User\VO\CommonName;
use Ronos\Domain\User\User;

class UpdateUserUsecase {


    public function __construct(private UsersRepositoryInterface $repo)
    { }

    public function execute(string $userId, array $data): UpdateUserOutput
    {
        try {
            $user = $this->repo->find($userId);

            $update = new User(
                $user->getUuid(),
                new CommonName('firstname', $data['firstname']),
                new CommonName('lastname', $data['lastname']),
                new Email($data['email']),
                new Password($user->getPassword()),
            );
   
            $this->repo->update($update);

            return new UpdateUserOutput(true);

        } catch (\Throwable $th) {
            return new UpdateUserOutput(
                success: false,
                errorType: $th,
                errors: [$th->field => $th->getMessage()]
            );
        }
    }
}