<?php

namespace App\Services;

use App\Models\Interfaces\RouteInterface;
use App\Services\Interfaces\RequestInterface;
use App\Services\Interfaces\RouteMatcherInterface;
use App\Services\Interfaces\RouterInterface;

class Router implements RouterInterface
{
    private array $routes = [];

    private Request $request;

    private RouteMatcher $routeMatcher;

    public function __construct(RequestInterface $request, RouteMatcherInterface $routeMatcher)
    {
        $this->request = $request;
        $this->routeMatcher = $routeMatcher;
    }

    public function addGet(RouteInterface $route, callable $callback): void
    {
        $route->setCollable($callback);
        $this->routes[Request::GET][$route->getPath()] = $route;
    }

    public function addPost(RouteInterface $route, callable $callback): void
    {
        $route->setCollable($callback);
        $this->routes[Request::POST][$route->getPath()] = $route;
    }

    public function resolve(): array
    {
        $method = $this->request->getMethod();
        $url = $this->request->getRoute();

        /**@var array $routesByMethod */
        $routesByMethod = $this->routes[$method];

        /**@var [route] $matchesRoutes */ 
        $matchesRoutes = array_filter($routesByMethod, function (RouteInterface $route) use ($url) {
            return $this->routeMatcher->matchRouteWithUrl($route, $url);
        }); 

        if (count($matchesRoutes) > 0) {
            /**@var RouteInterface $currentRoute */
            $currentRoute = reset($matchesRoutes);
            return [
                'callable' =>  $currentRoute->getCollable(),
                'params' => $this->routeMatcher->parseParamsFromUrl($currentRoute, $url),
            ];
        }
        
        return  function () {
            http_response_code(404);
            return 'Page not found!';
        };
    }

}
