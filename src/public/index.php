<?php
require_once '../../vendor/autoload.php';

use App\Services\Application;

$router = include '../config/routes.php';

$app = new Application();

echo $app->run($router);