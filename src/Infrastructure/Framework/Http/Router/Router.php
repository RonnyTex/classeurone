<?php

namespace Infrastructure\Framework\Http\Router;

use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Http\Controllers\AbstractController;
use Infrastructure\Framework\Http\Controllers\ControllerHandler;
use Infrastructure\Framework\Http\Router\Route;
use Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;
use Infrastructure\Framework\Http\Middlewares\MiddlewaresPipeline;
use Infrastructure\Framework\Security\TokenGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router {
    
    private array $routes = [];

    public function __construct(
        private ContainerInterface $container
    ) {}

    public function get(string $path, array $handler, ?string $name = null): Route
    {   
        if($name === null){
            $name = TokenGenerator::generate(16);
        }
        if($this->routeExists($name)){
            throw new \LogicException("La route $name existe déjà");
        }
        $route = new Route('GET', $path, $handler, $name);
        $this->routes[] = $route;
        return $route;
    }

    public function post(string $path, array $handler, ?string $name = null): Route
    {   
        if($name === null){
            $name = TokenGenerator::generate(16);
        }
        if($this->routeExists($name)){
            throw new \LogicException("La route $name existe déjà");
        }
        $route = new Route('POST', $path, $handler, $name);
        $this->routes[] = $route;
        return $route;
    }

    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        foreach($this->routes as $route){

            $params = $route->match($request->getMethod(), $request->getUri()->getPath());
              
            if($params !== false){

                [$controller, $method] = $route->getHandler();

                # Résolution par le container
                $instance = $this->container->get($controller);

                # Set le container dans le AbstractController
                if($instance instanceof AbstractController){
                    $instance->setContainer($this->container);
                }

                $finalHandler = new ControllerHandler($instance, $method);

                $pipeline = new MiddlewaresPipeline($this->container, $route->getMiddlewares(), $finalHandler);


                return $pipeline->handle($request);
             
            }
        }

        return new HtmlResponse('404 Content not found', 404);
    }

    public function findRoute(string $name): ?string
    {
        foreach ($this->routes as $route) {
            if($route->getName() === $name){
                return $route->getPath();
            }
        }
        return null;
    }

    private function routeExists(string $name): bool
    {
        $find = false;
        foreach ($this->routes as $route) {
            if($route->getName() === $name){
                $find = true;
            }
        }
        return $find;
    }
}