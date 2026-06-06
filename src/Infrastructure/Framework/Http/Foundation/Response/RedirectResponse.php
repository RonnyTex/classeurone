<?php

namespace Infrastructure\Framework\Http\Foundation\Response;

use GuzzleHttp\Psr7\Response;

class RedirectResponse extends Response
{
    public function __construct(string $url, int $status = 302)
    {
        parent::__construct($status, ['Location' => $url], '');
    }
}