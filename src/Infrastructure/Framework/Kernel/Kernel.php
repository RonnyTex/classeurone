<?php

namespace Infrastructure\Framework\Kernel;

use GuzzleHttp\Psr7\ServerRequest;
use Infrastructure\Framework\Config\ConfigInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Container\Container;
use Infrastructure\Framework\Http\Router\Router;
use Infrastructure\Framework\Http\Foundation\Response\HtmlResponse;
use Infrastructure\Framework\Http\Middlewares\MiddlewaresPipeline;
use Infrastructure\Framework\Http\Router\RouterHandler;
use Psr\Http\Message\ResponseInterface;

class Kernel {

    private array $providers = [];
    private array $middlewares = [];
    private ?ContainerInterface $container = null;
    private ?Router $router = null;
    private string $routesPath = "";

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

    public function setRoutesPath(string $path): void
    {
        $this->routesPath = $path;
    }

    // Démarre l'application
    public function run(?ServerRequest $request = null): ResponseInterface
    {
        try {
            $this->boot();
            $request = $request ?? ServerRequest::fromGlobals();

            $finalHandler = new RouterHandler($this->router);
            $pipeline = new MiddlewaresPipeline($this->container, $this->middlewares, $finalHandler);

            $response = $pipeline->handle($request);
            
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


        // chargement des configurations
        $config = $this->container->get(ConfigInterface::class);
        $settings = $config->load();
        $config->setSettings($settings ?? []);


        // Chargement des routes
        $router = new Router($containerInterface);
        $this->router = $router;
        require $this->routesPath ?: ROOT_PATH . '/start/routes.php';

    }


}