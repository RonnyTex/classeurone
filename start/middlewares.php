<?php

use Infrastructure\Framework\Http\Middlewares\CsrfMiddleware;
use Infrastructure\Framework\Http\Middlewares\TrailingSlashMiddleware;

$app->use(CsrfMiddleware::class);
$app->use(TrailingSlashMiddleware::class);