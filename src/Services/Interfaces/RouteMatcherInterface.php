<?php

namespace App\Services\Interfaces;

use App\Models\Interfaces\RouteInterface;

interface RouteMatcherInterface
{
    public function matchRouteWithUrl(RouteInterface $route, string $url): bool;

    public function parseParamsFromUrl(RouteInterface $route, string $url): array;
}
