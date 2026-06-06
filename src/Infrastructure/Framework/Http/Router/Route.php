<?php 

namespace Infrastructure\Framework\Http\Router;

class Route {

    private string $regex;

    private array $middlewares = [];

    public function __construct
    (
        private string $method,
        private string $path,
        private array $handler,
        private string $name
    ) 
    {
        # Convertit /product/{id} en regex: #^/product/(?P<id>[^/]+)$#
        $this->regex = $this->compilePath($path);
    }
    
    public function match(string $method, string $uri): false | array
    {
        if($method !== $this->method){
            return false;
        }

        if(preg_match($this->regex, $uri, $matches)){
            return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        }

        return false;
    }

    public function middleware(string $name): self
    {
        $this->middlewares[] = $name;
        return $this;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function getHandler(): array
    {
        return $this->handler;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    private function compilePath(string $path): string
    {
        $pattern = preg_replace('#:([a-zA-Z_][a-zA-Z0-9_]*)#', '(?P<$1>[^/]+)', $path);
        return '#^' . $pattern . '$#'; 
    }

}