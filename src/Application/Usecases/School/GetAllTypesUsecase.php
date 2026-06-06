<?php

namespace Application\Usecases\School;

use Domain\School\Type\TypesRepositoryInterface;

class GetAllTypesUsecase {

    public function __construct(private TypesRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    
    public function execute()
    {
        $roles = $this->repo->all();
        return $roles;
    }

}