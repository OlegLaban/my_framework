<?php

namespace App\Models\Interfaces;

interface RouteInterface 
{
    public function __construct(string $path);

    public function hasAliases(): bool;

    public function getPath(): string;

    public function setCollable(callable $callable): self;

    public function getCollable(): callable;
}
