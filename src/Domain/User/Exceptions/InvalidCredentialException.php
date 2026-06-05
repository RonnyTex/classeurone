<?php

namespace Ronos\Domain\User\Exceptions;
use Ronos\Domain\Exceptions\ValidationException;

class InvalidCredentialException extends ValidationException {

    public function __construct(string $message){
        parent::__construct('email', $message);
    }
}