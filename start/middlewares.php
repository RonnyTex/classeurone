<?php

use Ronos\Infrastructure\Framework\Http\Middlewares\CsrfMiddleware;
use Ronos\Infrastructure\Framework\Http\Middlewares\TrailingSlashMiddleware;

$app->use(CsrfMiddleware::class);
$app->use(TrailingSlashMiddleware::class);