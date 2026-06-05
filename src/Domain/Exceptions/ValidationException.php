<?php

namespace Ronos\Domain\Exceptions;

class ValidationException extends \Exception {

    public $field;

    public function __construct(string $field, string $message){
        $this->message = $message;
        $this->field = $field;
    }
}