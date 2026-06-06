<?php

namespace Domain\User\Status;

class Status {

    public function __construct
    (
        private string $name
    )
    {
        $this->name = $name;
    }

}