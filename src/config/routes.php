<?php 
use App\Services\Router;

$router = new Router();

$router->addPost('/', function () {
    return 'Hello World';
});

return $router;