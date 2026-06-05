<?php

namespace Ronos\Application\Usecases\Auth;

use Ronos\Application\DTO\Auth\LogoutUserOutput;
use Ronos\Domain\Auth\AuthInterface;


class LogoutUserUsecase {

    public function __construct
    (
        private AuthInterface $auth
    )
    { }

    public function execute(): LogoutUserOutput
    {
        try {
   
            $this->auth->logout();

            return new LogoutUserOutput(true);

        } catch (\Throwable $th) {
               return new LogoutUserOutput(
                success: false,
                errorType: $th
            );
        }
    }
}