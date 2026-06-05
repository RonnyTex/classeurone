<?php


namespace Application\Usecases\Admin;

use Domain\User\UsersRepositoryInterface;
use Domain\User\Exceptions\UserNotFoundException;
use Application\DTO\User\UpdateUserOutput;
use Domain\User\VO\Email;
use Domain\User\VO\Password;
use Domain\User\VO\CommonName;
use Domain\User\User;

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