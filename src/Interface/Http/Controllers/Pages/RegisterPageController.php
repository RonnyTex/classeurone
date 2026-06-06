<?php

namespace Interface\Http\Controllers\Pages;

use Application\Usecases\School\GetAllTypesUsecase;
use Application\Usecases\User\GetAllRolesUsecase;
use Infrastructure\Framework\Http\Controllers\AbstractController;
use Psr\Http\Message\ResponseInterface;

class RegisterPageController extends AbstractController {

    public function __construct
    (
        private GetAllRolesUsecase $roleUc,
        private GetAllTypesUsecase $typeUc,

    )
    {
        $this->roleUc = $roleUc;
        $this->typeUc = $typeUc;
    }

    public function __invoke(): ResponseInterface
    {
        $roles = $this->roleUc->execute();
        $types = $this->typeUc->execute();

        return $this->render('site/register', [
            'csrf' => $this->getCsrfToken(),
            'roles' => $roles,
            'types' => $types
        ]);
    }
}