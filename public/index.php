<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Infrastructure\Framework\Kernel\Kernel;

$app = new Kernel();

require dirname(__DIR__) . '/start/middlewares.php';
require dirname(__DIR__) . '/start/providers.php';

$response = $app->run();
$response->send();
