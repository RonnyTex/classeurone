<?php

namespace Ronos\Domain\User\Exceptions;
use Ronos\Domain\Exceptions\ValidationException;

class InvalidPasswordException extends ValidationException {

    public function __construct(string $message){
        parent::__construct('psw', $message);
    }
}