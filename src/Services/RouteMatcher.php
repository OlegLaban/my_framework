<?php

namespace App\Services;

use App\Models\Interfaces\RouteInterface;
use App\Models\Route;
use App\Services\Interfaces\RouteMatcherInterface;

class RouteMatcher implements RouteMatcherInterface
{
    public function matchRouteWithUrl(RouteInterface $route, string $url): bool
    {
        $path = $route->getPath();        
        $pathExpression = $this->pathToExpression($path);
        return preg_match($pathExpression, $url);
    }

    public function parseParamsFromUrl(RouteInterface $route, string $url): array
    {
        $path = $route->getPath();
        $pathExpression = $this->pathToExpression($path);

        preg_match_all($pathExpression, $url, $values);
        preg_match_all(Route::HAS_ALIAS_REGEX, $path, $aliases);

        $values = array_slice($values, 1);
        $aliasesText = isset($aliases[1]) ? $aliases[1] : [];

        $aliasesValue = [];
        foreach ($values as $valueArr) {
            $aliasesValue = array_merge($aliasesValue, $valueArr);
        }

        $aliasesTextWithValue = [];
        foreach ($aliasesText as $index => $text) {
            $aliasesTextWithValue[$text] = $aliasesValue[$index];
        }

        return  $aliasesTextWithValue; 
    }

    private function pathToExpression(string $path): string
    {
       $path = preg_replace(Route::HAS_ALIAS_REGEX, '([\w|\d]+)', $path);
       return sprintf('/^%s$/', str_replace('/', '\/', $path));
    }
}
