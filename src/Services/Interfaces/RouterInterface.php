<?php

namespace App\Services\Interfaces;

use App\Models\Interfaces\RouteInterface;

interface RouterInterface
{
    public function addGet(RouteInterface $route, callable $callback): void;

    public function addPost(RouteInterface $route, callable $callback): void;

    public function resolve(): array;
}
