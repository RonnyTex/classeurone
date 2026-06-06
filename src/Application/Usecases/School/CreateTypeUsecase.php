<?php

namespace Application\Usecases\School;

use Domain\School\Type\Type;
use Domain\School\Type\TypesRepositoryInterface;

class CreateTypeUsecase {

    public function __construct
    (
        private TypesRepositoryInterface $repo,
    )
    { }

    public function execute(string $typeName)
    {
        $type = new Type($typeName);

        $this->repo->save($type);

    }
}