<?php

namespace App\Models;

use App\Models\Interfaces\RouteInterface;

class Route implements RouteInterface
{
    public const HAS_ALIAS_REGEX = '/\{(.+?)\}/';
    
    private string $path = '';
    
    private $callable = null;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }
    
    public function hasAliases(): bool
    {
        return preg_match(self::HAS_ALIAS_REGEX, $this->path);
    }

    public function setCollable(callable $callable): RouteInterface
    {
       $this->callable = $callable;
       return $this; 
    }

    public function getCollable(): callable
    {
        return $this->callable;
    }
}
