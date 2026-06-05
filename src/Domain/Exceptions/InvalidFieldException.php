<?php

namespace Ronos\Domain\Exceptions;
use Ronos\Domain\Exceptions\ValidationException;


class InvalidFieldException extends ValidationException {

    public function __construct(string $field, string $message){
        parent::__construct($field, $message);
    }
}