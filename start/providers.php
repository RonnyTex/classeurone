<?php

use Ronos\Infrastructure\Framework\Providers\AuthProvider;
use Ronos\Infrastructure\Framework\Providers\MiddlewaresProvider;
use Ronos\Infrastructure\Framework\Providers\ViewProvider;
use Ronos\Interface\Providers\EntityProvider;
use Ronos\Interface\Providers\AuthProvider as Auth;

$app->provide(ViewProvider::class);
$app->provide(AuthProvider::class);
$app->provide(EntityProvider::class);
$app->provide(MiddlewaresProvider::class);
$app->provide(Auth::class);