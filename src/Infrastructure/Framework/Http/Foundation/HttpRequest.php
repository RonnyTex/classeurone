<?php

namespace Ronos\Infrastructure\Framework\Http\Foundation;

class HttpRequest {

    private string $method;
    private string $uri;
    private array $query;
    private array $body;
    private array $params = [];

    public function __construct(string $method, string $uri, array $query, array $body)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->query = $query;
        $this->body = $body;
    }

    public static function capture(): self
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        $query = $_GET;
        $body = $_POST;

        # JSON body support
        if(empty($body)){
            $json = json_decode(file_get_contents('php://input'), true);
            if(is_array($json)){
                $body = $json;
            }
        }

        return new self($method, $uri, $query, $body);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}