<?php

namespace Infrastructure\Framework\Providers;

use Infrastructure\Framework\Config\ConfigInterface;
use Infrastructure\Framework\Kernel\ProviderInterface;
use Infrastructure\Framework\Container\ContainerInterface;
use Infrastructure\Framework\Config\Config;
use Infrastructure\Framework\Env\Env;

class ConfigProvider implements ProviderInterface {

    public function register(ContainerInterface $c)
    {
        $c->set(ConfigInterface::class, fn() => new Config());
        $c->set('env', fn() => new Env());
    }

    public function boot(ContainerInterface $c)
    {

    }
}