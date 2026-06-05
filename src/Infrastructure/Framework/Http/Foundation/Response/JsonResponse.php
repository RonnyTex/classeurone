<?php

namespace Infrastructure\Framework\Http\Foundation\Response;

use Infrastructure\Framework\Http\Foundation\Response\HttpResponse;

class JsonResponse extends HttpResponse {

    public function __construct(array $data, int $status = 200)
    {
        parent::__construct($status, [
            'Content-type' => 'application/json'
        ], json_encode($data));
    }

}