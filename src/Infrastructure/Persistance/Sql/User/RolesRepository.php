<?php

namespace Infrastructure\Persistance\Sql\User;

use Domain\User\Roles\Role;
use Domain\User\Roles\RolesRepositoryInterface;
use Infrastructure\Framework\Database\Database;

class RolesRepository implements RolesRepositoryInterface {

    public function all(): ?array
    {
        $roles = Database::fetchAll("SELECT * FROM roles");

        if(count($roles) >= 1){
            return $roles;
        }

        return null;
    }

    public function save(Role $role): void
    {
        Database::execute("INSERT INTO roles (name) VALUES (:name)", [
            'name' => $role->getName()
        ]);
    }


}