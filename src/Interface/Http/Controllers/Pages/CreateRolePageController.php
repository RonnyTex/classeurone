<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;

use Psr\Http\Message\ResponseInterface;


class CreateRolePageController extends AbstractController {

    public function __invoke(): ResponseInterface
    {
        $crsf = $this->getCsrfToken();
        return $this->render('roles/create', ['csrf' => $crsf]);
    }
}