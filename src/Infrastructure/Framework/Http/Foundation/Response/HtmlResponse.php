<?php

namespace Infrastructure\Framework\Http\Foundation\Response;

use GuzzleHttp\Psr7\Response;

class HtmlResponse extends Response {

    public function __construct(string $content, int $status = 200)
    {
        parent::__construct($status, [
            'Content-type' => 'text/html; charset=utf-8'
        ], $content);
    }

}