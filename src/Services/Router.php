<?php
namespace App\Services;

class Router
{
    private array $routes = [];

    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function addGet(string $route, callable $callback): void
    {
        $this->routes[Request::GET][$route] = $callback;
    }

    public function addPost(string $route, callable $callback): void
    {
        $this->routes[Request::POST][$route] = $callback;
    }

    public function resolve(): callable
    {
        $method = $this->request->getMethod();
        $route = $this->request->getRoute();
        if (isset($this->routes[$method][$route])) {
            return $this->routes[$method][$route];
        }
        return  function () {
            http_response_code(404);
            return 'Page not found!';
        };
    }

}