<?php

namespace Infrastructure\Framework\Kernel;

use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Container\Container;
use Infrastructure\Framework\Http\Router\Router;
use Infrastructure\Framework\Http\Foundation\Response\ResponseInterface;
use Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;
use Infrastructure\Framework\Http\Foundation\HttpRequest;


class Kernel {

    private array $providers = [];
    private array $middlewares = [];

    /**
     * Enregistre un middleware global
     * @var string $middleware
     */
    public function use(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Enregistre un nouveau provider
     */
    public function provide(string $provider): void
    {
        $this->providers[] = $provider;
    }

    // Démarre l'application
    public function run(): ResponseInterface
    {
        try {
            $this->boot();
            $request = HttpRequest::capture();

            # Exécution des middlewares globals
            foreach($this->middlewares as $mw){
                $middleware = $this->container->get($mw);
                $response = $middleware->handle($request);
                if($response !== null){
                    return $response;
                }
            }

            $response = $this->router->dispatch($request);
        } catch (\Throwable $th) {
            $response = new HtmlResponse($th->getMessage(), 500);
        }
        return $response;
    }

     // bootstrap
    public function boot()
    {
        $this->container = new Container();
        $this->container->set(ContainerInterface::class, fn() => $this->container);
        $containerInterface = $this->container->get(ContainerInterface::class);
        
        // Enregistrement des services
        foreach ($this->providers as $provider) {
            $instance = new $provider();
            $instance->register($containerInterface);
        }

        // Chargement des routes
        $router = new Router($containerInterface);
        $this->router = $router;
        require dirname(__DIR__, 4) . '/start/routes.php';

    }


}