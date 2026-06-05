<?php

namespace Ronos\Infrastructure\Framework\Http\Foundation\Response;

use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;

class HttpResponse implements ResponseInterface {

    private int $status;
    private  array $headers;
    private string $content;

    public function __construct(int $status = 200, array $headers = [], $content = '')
    {
        $this->status = $status;
        $this->headers = $headers;
        $this->content = $content;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function send(): void
    {
        http_response_code($this->status);
        
        foreach($this->headers as $key => $value){
            header("$key: $value");
        }

        echo $this->content;
    }
}