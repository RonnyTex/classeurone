<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Database\Seeders\UserRolesSeeder;
use Infrastructure\Framework\Kernel\Kernel;
use function Http\Response\send;

define('ROOT_PATH', dirname(__DIR__));

$app = new Kernel();


require dirname(__DIR__) . '/start/middlewares.php';
require dirname(__DIR__) . '/start/providers.php';


$response = $app->run();

send($response);


