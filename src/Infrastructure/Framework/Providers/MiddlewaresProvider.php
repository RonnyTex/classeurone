<?php

namespace Infrastructure\Framework\Providers;

use Infrastructure\Framework\Kernel\ProviderInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Http\Middlewares\CsrfMiddleware;
use Infrastructure\Framework\Http\Middlewares\TrailingSlashMiddleware;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;

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