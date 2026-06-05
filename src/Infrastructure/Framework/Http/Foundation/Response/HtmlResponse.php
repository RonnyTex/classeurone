<?php

namespace Infrastructure\Framework\Http\Foundation\Response;

use Infrastructure\Framework\Http\Foundation\Response\HttpResponse;

class HtmlResponse extends HttpResponse {

    public function __construct(string $content, int $status = 200)
    {
        parent::__construct($status, [
            'Content-type' => 'text/html; charset=utf-8'
        ], $content);
    }

}