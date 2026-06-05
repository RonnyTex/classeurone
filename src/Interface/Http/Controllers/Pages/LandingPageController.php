<?php

namespace Ronos\Interface\Http\Controllers\Pages;

use Ronos\Infrastructure\Framework\Http\Controllers\AbstractController;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;

class LandingPageController extends AbstractController {

    public function __invoke(): ResponseInterface
    {
        return $this->render('site/index');         
    }
}