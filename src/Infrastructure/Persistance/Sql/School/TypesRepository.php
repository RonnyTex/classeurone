<?php

namespace Infrastructure\Persistance\Sql\School;

use Domain\School\Type\Type;
use Domain\School\Type\TypesRepositoryInterface;
use Infrastructure\Framework\Database\Database;

class TypesRepository implements TypesRepositoryInterface {

    public function all(): ?array
    {
        $types = Database::fetchAll("SELECT * FROM school_types");

        if(count($types) >= 1){
            return $types;
        }

        return null;
    }

    public function save(Type $type): void
    {
        Database::execute("INSERT INTO school_types (name) VALUES (:name)", [
            'name' => $type->getName()
        ]);
    }


}