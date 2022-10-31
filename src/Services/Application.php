<?php
namespace App\Services;

class Application
{
    public function run(Router $router): string
    {
        $callable = $router->resolve();
        return call_user_func($callable);
    }
}