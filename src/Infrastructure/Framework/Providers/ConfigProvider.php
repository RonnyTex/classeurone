<?php

namespace Infrastructure\Framework\Providers;

use Infrastructure\Framework\Config\ConfigInterface;
use Infrastructure\Framework\Kernel\ProviderInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Config\Config;

class ConfigProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(ConfigInterface::class, fn() => new Config());
    }

    public function boot(ContainerInterface $c)
    {

    }
}