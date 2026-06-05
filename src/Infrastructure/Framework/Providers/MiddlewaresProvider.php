<?php

namespace Ronos\Infrastructure\Framework\Providers;

use Ronos\Infrastructure\Framework\Kernel\ProviderInterface;
use Ronos\Infrastructure\Framework\Container\ContainerInterface;
use Ronos\Infrastructure\Framework\Http\Middlewares\CsrfMiddleware;
use Ronos\Infrastructure\Framework\Http\Middlewares\TrailingSlashMiddleware;
use Ronos\Infrastructure\Framework\Http\Foundation\Session\SessionInterface;

class MiddlewaresProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(CsrfMiddleware::class, fn($c) => new CsrfMiddleware(
            $c->get(SessionInterface::class)
        ));

        $c->set(TrailingSlashMiddleware::class, fn () => new TrailingSlashMiddleware() );
        
    }
    
    public function boot(ContainerInterface $c)
    {

    }

}