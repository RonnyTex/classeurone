<?php

namespace Ronos\Infrastructure\Framework\Http\Router;

use Ronos\Infrastructure\Framework\Container\ContainerInterface;
use Ronos\Infrastructure\Framework\Http\Controllers\AbstractController;
use Ronos\Infrastructure\Framework\Http\Router\Route;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Ronos\Infrastructure\Framework\Http\Foundation\HttpRequest;
use Ronos\Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;
use Ronos\Infrastructure\Framework\Security\TokenGenerator;

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

    public function dispatch(HttpRequest $request): ResponseInterface
    {
        foreach($this->routes as $route){

            $params = $route->match($request->getMethod(), $request->getUri());
              
            if($params !== false){

                # Stocker les params dans la request
                $request->setParams($params);
                
                # Exécution des middlewares
                foreach($route->getMiddlewares() as $mw){
                    $middleware = $this->container->get($mw);
                    $response = $middleware->handle($request);
                    if($response !== null){
                        return $response;
                    }
                }

                [$controller, $method] = $route->getHandler();

                # Résolution par le container
                $instance = $this->container->get($controller);

                # Set le container dans le AbstractController
                if($instance instanceof AbstractController){
                    $instance->setContainer($this->container);
                }

                # Gestion des controllers invocables avec la méthode __invoke
                if($method === null){
                    if(!is_callable($instance)) {
                        throw new \Exception("Le controller $controller n'est pas callable. Une méthode est attentude.");
                    }
                        
                    return $instance($request);
                }

                return $instance->$method($request); 
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