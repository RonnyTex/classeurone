<?php

namespace Ronos\Application\Usecases\User;

use Ronos\Domain\User\UsersRepositoryInterface;
use Ronos\Domain\User\Exceptions\EmailAlreadyExistsException;
use Ronos\Domain\User\Exceptions\InvalidEmailException;
use Ronos\Domain\User\Exceptions\InvalidPasswordException;
use Ronos\Domain\Exceptions\EmptyFieldException;
use Ronos\Domain\Exceptions\InvalidFieldException;
use Ronos\Domain\User\VO\Email;
use Ronos\Domain\User\VO\Password;
use Ronos\Domain\User\VO\CommonName;
use Ronos\Domain\User\User;
use Ronos\Domain\Auth\AuthInterface;
use Ronos\Infrastructure\Framework\Security\TokenGenerator;
use Ronos\Application\DTO\User\CreateUserOutput;
use Ronos\Application\DTO\User\CreateUserInput;

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