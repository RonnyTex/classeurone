<?php

namespace Infrastructure\Framework\Http\Foundation\Response;

use GuzzleHttp\Psr7\Response;

class JsonResponse extends Response {

    public function __construct(array $data, int $status = 200)
    {
        parent::__construct($status, [
            'Content-type' => 'application/json'
        ], json_encode($data));
    }

}