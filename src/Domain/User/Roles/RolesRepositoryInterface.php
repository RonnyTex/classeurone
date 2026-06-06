<?php

namespace Domain\User\Roles;

interface RolesRepositoryInterface {

    public function all(): ?array;

    public function save(Role $role): void;

}