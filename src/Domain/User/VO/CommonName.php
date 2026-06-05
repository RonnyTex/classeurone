<?php

namespace Domain\User\VO;

use Domain\Exceptions\InvalidFieldException;
use Domain\Exceptions\EmptyFieldException;

class CommonName {

    private string $value;

    public function __construct(string $field, string $value)
    {
        $this->value = $value;

        $lenght = mb_strlen(trim($value));

        if(empty($value)) {
            throw new EmptyFieldException($field, "Le champs est vide");
        }

        if($lenght < 2){
            throw new InvalidFieldException($field, 'Doit contenir au moins 2 caractères');
        }

        if($lenght > 50){
            throw new InvalidFieldException($field, 'Ne peux pas dépasser 50 caractères');
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}