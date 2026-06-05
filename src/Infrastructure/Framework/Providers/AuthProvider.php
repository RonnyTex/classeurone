<?php

namespace Ronos\Infrastructure\Framework\Providers;

use Ronos\Infrastructure\Framework\Kernel\ProviderInterface;
use Ronos\Infrastructure\Framework\Container\ContainerInterface;
use Ronos\Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Ronos\Infrastructure\Framework\Http\Foundation\Session\Session;
use Ronos\Infrastructure\Framework\Http\Middlewares\AuthMiddleware;
use Ronos\Infrastructure\Framework\Http\Auth\SessionAuth;
use Ronos\Infrastructure\Framework\Http\Auth\AuthInterface;

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