<?php

namespace Domain\School;

use Domain\VO\Email;

class School {

    public function __construct
    (
        private string $name,
        private Email $email,
        private int $phone,
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;     
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email->getValue();
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

}