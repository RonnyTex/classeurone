<?php

namespace Domain\User\Exceptions;
use Domain\Exceptions\ValidationException;

class InvalidEmailException extends ValidationException {

    public function __construct(string $message){
        parent::__construct('email', $message);
    }
}