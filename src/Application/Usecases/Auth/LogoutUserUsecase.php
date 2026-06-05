<?php

namespace Application\Usecases\Auth;

use Application\DTO\Auth\LogoutUserOutput;
use Domain\Auth\AuthInterface;


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