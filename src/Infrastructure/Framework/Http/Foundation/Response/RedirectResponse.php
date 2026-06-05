<?php

namespace Ronos\Infrastructure\Framework\Http\Foundation\Response;

use Ronos\Infrastructure\Framework\Http\Foundation\Response\HttpResponse;

class RedirectResponse extends HttpResponse
{
    public function __construct(string $url, int $status = 302)
    {
        parent::__construct($status, ['Location' => $url], '');
    }
}