<?php

use Infrastructure\Framework\Providers\AuthProvider;
use Infrastructure\Framework\Providers\MiddlewaresProvider;
use Infrastructure\Framework\Providers\ViewProvider;
use Interface\Providers\EntityProvider;
use Interface\Providers\AuthProvider as Auth;

$app->provide(ViewProvider::class);
$app->provide(AuthProvider::class);
$app->provide(EntityProvider::class);
$app->provide(MiddlewaresProvider::class);
$app->provide(Auth::class);