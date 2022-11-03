<?php
namespace App\Services;

class Application
{
    public function run(Router $router): string
    {
        $collableParams = $router->resolve();

        return call_user_func_array($collableParams['callable'], $collableParams['params']);
    }
}
