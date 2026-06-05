<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;

class LoginPageController extends AbstractController {

    public function __invoke(): ResponseInterface
    {
        if($this->isAuthenticated()){
            return $this->redirect('/app');
        }

        return $this->render('login', ['csrf' => $this->getCsrfToken()]);         
    }
}