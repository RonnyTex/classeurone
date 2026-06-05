<?php

namespace Ronos\Infrastructure\Framework\Providers;

use Ronos\Infrastructure\Framework\Kernel\ProviderInterface;
use Ronos\Infrastructure\Framework\Container\ContainerInterface;
use Ronos\Infrastructure\Framework\View\ViewInterface;
use Ronos\Infrastructure\Framework\View\PhpView;

class ViewProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(ViewInterface::class, fn() => new PhpView());
    }

    public function boot(ContainerInterface $c)
    {

    }

}