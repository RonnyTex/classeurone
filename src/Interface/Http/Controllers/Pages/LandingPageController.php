<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;

use Psr\Http\Message\ResponseInterface;

class LandingPageController extends AbstractController {

    public function __invoke(): ResponseInterface
    {
        return $this->render('site/index');         
    }
}