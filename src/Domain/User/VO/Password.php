<?php

namespace Domain\User\VO;

use Domain\Exceptions\EmptyFieldException;
use Domain\User\Exceptions\InvalidPasswordException;

class Password {

    private string $value;

    public function __construct(string $value = ''){

        $this->value = $value;

        if(empty($value)) {
            throw new EmptyFieldException('psw',"Le champs Mot de passe est vide");
        }
        
        if(strlen($value) < 8) {
            throw new InvalidPasswordException("Le mot de passe doit contenir 8 caracteres.");
        }

        if(!preg_match('/[A-Z]/', $value)){
            throw new InvalidPasswordException("Le mot de passe doit contenir une majuscule");
        }

        if(!preg_match('/[\W_]/', $value)){
            throw new InvalidPasswordException("Le mot de passe doit contenir un caractère spécial");
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function makeHash(string $value): string
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }

    public static function match(string $value, string $expected): bool
    {
        return $value === $expected;
    }

    public static function verify(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}