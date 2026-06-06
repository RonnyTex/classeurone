<?php

namespace Tests\Framework\Kernel;

use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;

class TestController extends AbstractController {

    public function __invoke()
    {
        return new HtmlResponse('hello');
    }

}