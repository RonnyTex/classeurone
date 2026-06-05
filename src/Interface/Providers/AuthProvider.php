<?php

namespace Ronos\Interface\Providers;

use Ronos\Infrastructure\Framework\Kernel\ProviderInterface;
use Ronos\Infrastructure\Framework\Container\ContainerInterface;
use Ronos\Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Ronos\Infrastructure\Framework\Http\Auth\SessionAuth;
use Ronos\Infrastructure\Auth\AuthAdapter;
use Ronos\Domain\Auth\AuthInterface;

class AuthProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(AuthInterface::class, fn($c) => new AuthAdapter(new SessionAuth($c->get(SessionInterface::class))));
    }

    public function boot(ContainerInterface $c)
    {

    }
}