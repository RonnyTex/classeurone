<?php

namespace Ronos\Interface\Http\Controllers\Pages;

use Ronos\Infrastructure\Framework\Http\Controllers\AbstractController;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;

class LoginPageController extends AbstractController {

    public function __invoke(): ResponseInterface
    {
        if($this->isAuthenticated()){
            return $this->redirect('/app');
        }

        return $this->render('login', ['csrf' => $this->getCsrfToken()]);         
    }
}