<?php

namespace Application\DTO\User;

class CreateUserInput {

    public function __construct
    (
        public string $firstname, 
        public string $lastname, 
        public string $email, 
        public string $password,
        public string $passwordConfirm
    )
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
    }
}