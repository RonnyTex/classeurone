<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;

use Psr\Http\Message\ResponseInterface;

class RegisterPageController extends AbstractController {

    public function __invoke(): ResponseInterface
    {
        return $this->render('site/register', ['csrf' => $this->getCsrfToken()]);
    }
}