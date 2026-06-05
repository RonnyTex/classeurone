<?php

namespace Interface\Http\Controllers\Pages;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;

class LandingPageController extends AbstractController {

    public function __invoke(): ResponseInterface
    {
        return $this->render('site/index');         
    }
}