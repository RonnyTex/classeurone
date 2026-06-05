<?php

namespace Domain\User;

use Domain\Exceptions\EmptyFieldException;
use Domain\User\VO\Email;
use Domain\User\VO\Password;
use Domain\User\VO\CommonName;

class User {

    public function __construct
    (
        private string $uuid,
        private CommonName $firstname,
        private CommonName $lastname,
        private Email $email, 
        private Password $password,
        private ?\DateTimeImmutable $createdAt = null,
        private ?\DateTimeImmutable $updatedAt = null,
    )
    {   

        $this->uuid = $uuid;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getFirstname(): string 
    {
        return $this->firstname->getValue();
    }

    public function getLastname(): string
    {
        return $this->lastname->getValue();
    }

    public function getEmail(): string
    {
        return $this->email->getValue();
    }

    public function getPassword(): string
    {
        return $this->password->getValue();
    }
}