<?php

namespace Database\Seeders;

use Infrastructure\Framework\Database\Database;

class UserRolesSeeder {

    private array $data = [
        "Directeur / Directrice",
        "Sous-directeur / Sous-directrice",
        "Responsable administratif",
        "Responsable informatique (IT)",
        "Responsable pédagogique",
        "Responsable RH",
        "Secrétaire de direction",
        "Coordinateur / Coordinatrice",
        "Gestionnaire de l'établissement",
        "Membre du pouvoir organistateur (PO)"
    ];

    public function seed(): void
    {
        foreach ($this->data as $name) {
            Database::execute("INSERT INTO roles name VALUES (:name)", [
                'name' => $name
            ]); 
        }
    }
}