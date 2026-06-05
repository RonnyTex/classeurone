<?php

namespace Domain\User\Exceptions;
use Domain\Exceptions\ValidationException;

class UserNotFoundException extends ValidationException {

    public function __construct(string $message){
        parent::__construct('email', $message);
    }
}