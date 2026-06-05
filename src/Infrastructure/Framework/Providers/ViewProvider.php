<?php

namespace Infrastructure\Framework\Providers;

use Infrastructure\Framework\Kernel\ProviderInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\View\ViewInterface;
use Infrastructure\Framework\View\PhpView;

class ViewProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(ViewInterface::class, fn() => new PhpView());
    }

    public function boot(ContainerInterface $c)
    {

    }

}