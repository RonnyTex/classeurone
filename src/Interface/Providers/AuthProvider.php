<?php

namespace Interface\Providers;

use Infrastructure\Framework\Kernel\ProviderInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Http\Foundation\Session\SessionInterface;
use Infrastructure\Framework\Http\Auth\SessionAuth;
use Infrastructure\Auth\AuthAdapter;
use Domain\Auth\AuthInterface;

class AuthProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(AuthInterface::class, fn($c) => new AuthAdapter(new SessionAuth($c->get(SessionInterface::class))));
    }

    public function boot(ContainerInterface $c)
    {

    }
}