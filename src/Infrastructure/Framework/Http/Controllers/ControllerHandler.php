<?php

namespace Infrastructure\Framework\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Psr\Http\Server\RequestHandlerInterface;

class ControllerHandler implements RequestHandlerInterface {

    private mixed $controller;
    private ?string $method;

    public function __construct(mixed $controller, ?string $method = null)
    {
        $this->controller = $controller;
        $this->method = $method;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $controller = $this->controller;

        if($this->method === null){
            if(!is_callable($this->controller)) {
                throw new \Exception("Le controller n'est pas callable. Une méthode est attentude.");
                }
                        
                
                return $controller($request);
            }

            $method = $this->method;
            return $controller->$method($request); 
    }

}