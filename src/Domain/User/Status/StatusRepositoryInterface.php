<?php

namespace Domain\User\Status;

interface StatusRepositoryInterface {

    public function all(): array;
    
}