<?php

namespace Infrastructure\Framework\Providers;

use Infrastructure\Framework\Kernel\ProviderInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Foundation\Session\Session;
use Infrastructure\Framework\Http\Middlewares\AuthMiddleware;
use Infrastructure\Framework\Http\Auth\SessionAuth;
use Infrastructure\Framework\Http\Auth\AuthInterface;

class AuthProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(SessionInterface::class, fn() => new Session());
        $c->set(AuthInterface::class, fn($c) => new SessionAuth($c->get(SessionInterface::class)));
        $c->set('auth', fn($c) => new AuthMiddleware(
            $c->get(SessionInterface::class),
            $c->get(AuthInterface::class),
        ));
    }

    public function boot(ContainerInterface $c)
    {

    }
}