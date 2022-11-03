<?php

use App\Models\Route;
use App\Services\Request;
use App\Services\RouteMatcher;
use App\Services\Router;

$router = new Router(new Request($_SERVER), new RouteMatcher());

$router->addPost(new Route('/todo'), function () {
    return 'Logic for create TODO';
});
$router->addPost(new Route('/todo/{id}'), function () {
    return 'Logic Delete todo';
});

$router->addGet(new Route('/todos'), function () {
    return 'Logic for get all todos';
});

$router->addGet(new Route('/todo/{id}'), function () {
    return 'Logic for get single todo';
});

$router->addGet(new Route('/todo/{id}/todoitem/{name}'), function (int $id, string $name) {
    return 'Logic for action with many parameters';
});

return $router;
