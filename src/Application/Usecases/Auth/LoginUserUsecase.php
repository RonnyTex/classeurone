<?php

namespace Application\Usecases\Auth;

use Domain\User\UsersRepositoryInterface;
use Domain\Auth\AuthInterface;
use Domain\User\VO\Password;
use Domain\User\Exceptions\InvalidCredentialException;
use Application\DTO\Auth\LoginUserOutput;


class LoginUserUsecase {

    public function __construct
    (
        private UsersRepositoryInterface $repo,
        private AuthInterface $auth
    )
    { }

    public function execute(string $email, string $password): LoginUserOutput
    {
        try {
            $user = $this->repo->findByEmail($email);

            if(is_null($user)){
                throw new InvalidCredentialException('Adresse email et/ou mot de passe invalide');
            }

            if(!Password::verify($password, $user->getPassword())){
                throw new InvalidCredentialException('Adresse email et/ou mot de passe invalide');
            }

            $this->auth->login($user->getUuid());

            return new LoginUserOutput(true);

        } catch (\Throwable $th) {
            return new LoginUserOutput(
                success: false,
                errorType: $th,
                errors: [$th->field => $th->getMessage()]
            );
        }
    }
}