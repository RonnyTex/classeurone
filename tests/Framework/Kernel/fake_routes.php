<?php

use Infrastructure\Framework\Container\Container;
use Infrastructure\Framework\Http\Router\Router;
use Tests\Framework\Kernel\TestController;

$container = new Container();

$router = new Router($container);

$router->get('/', [TestController::class]);