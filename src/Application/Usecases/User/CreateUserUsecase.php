<?php

namespace Application\Usecases\User;

use Domain\User\UsersRepositoryInterface;
use Domain\User\Exceptions\EmailAlreadyExistsException;
use Domain\User\Exceptions\InvalidEmailException;
use Domain\User\Exceptions\InvalidPasswordException;
use Domain\Exceptions\EmptyFieldException;
use Domain\Exceptions\InvalidFieldException;
use Domain\User\VO\Email;
use Domain\User\VO\Password;
use Domain\User\VO\CommonName;
use Domain\User\User;
use Domain\Auth\AuthInterface;
use Infrastructure\Framework\Security\TokenGenerator;
use Application\DTO\User\CreateUserOutput;
use Application\DTO\User\CreateUserInput;

class CreateUserUsecase {

    public function __construct
    (
        private UsersRepositoryInterface $repo,
        private AuthInterface $auth
    )
    { }

    public function execute(CreateUserInput $input): CreateUserOutput
    {
        try {
            $createdAt = new \DateTimeImmutable();
            $updateddAt = new \DateTimeImmutable();
 
            $user = new User(
                TokenGenerator::generate(16),
                new CommonName('firstname', $input->firstname),
                new CommonName('lastname', $input->lastname),
                new Email($input->email),
                new Password($input->password),
                $createdAt,
                $updateddAt,
            );

            if(!Password::match($input->password, $input->passwordConfirm)){
                throw new InvalidFieldException('psw', 'Les mots de passes ne correspondent pas');
            }

            $this->repo->save($user);
            $this->auth->login($user->getUuid());
            
            return new CreateUserOutput(success: true);

        } catch (\Throwable $th) {
            return new CreateUserOutput(
                success: false,
                errorType: $th,
                errors: [$th->field ?? 'error' => $th->getMessage()]
            );
        }
    }
}