<?php

namespace App\Services\Interfaces;

interface RequestInterface
{
    public function getMethod(): string;

    public function getRoute(): string;
}
