<?php

namespace Domain\School\Type;

class Type {

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