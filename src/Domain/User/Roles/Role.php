<?php

namespace Domain\User\Roles;

class Role {

    public function __construct
    (
        private string $name
    )
    {
        $this->name = $name;   
    }

    public function getName(): string
    {
        return $this->name;
    }


}