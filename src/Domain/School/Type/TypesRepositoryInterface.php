<?php

namespace Domain\School\Type;

use Domain\School\Type\Type;

interface TypesRepositoryInterface {

    public function all(): ?array;

    public function save(Type $type): void;

}