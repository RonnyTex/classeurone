<?php
require_once __DIR__ . '/../autoload.php';

use Ronos\Infrastructure\Framework\Kernel\Kernel;

$app = new Kernel();

require dirname(__DIR__) . '/start/middlewares.php';
require dirname(__DIR__) . '/start/providers.php';

$response = $app->run();
$response->send();
