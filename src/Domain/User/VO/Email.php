<?php

namespace Ronos\Domain\User\VO;

use Ronos\Domain\User\Exceptions\InvalidEmailException;
use Ronos\Domain\Exceptions\EmptyFieldException;

class Email {

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;

        if(empty($value)) {
            throw new EmptyFieldException('email', "Le champs Email est vide");
        }

        if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
            throw new InvalidEmailException("Adresse email invalide");
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}