<?php

namespace Infrastructure\Framework\Http\Middlewares;

use Infrastructure\Framework\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Psr\Http\Server\RequestHandlerInterface;


class MiddlewaresPipeline implements RequestHandlerInterface {


    public function __construct(private ContainerInterface $container, private array $middlewares, private RequestHandlerInterface $finalHandler)
    {
        $this->container = $container;
        $this->middlewares = $middlewares;
        $this->finalHandler = $finalHandler;
    }

    
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if(empty($this->middlewares)){
            return $this->finalHandler->handle($request);
        }

        $middleware = array_shift($this->middlewares);
        $middleware = $this->container->get($middleware);
        return $middleware->process($request, $this);
    }
}