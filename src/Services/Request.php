<?php
namespace App\Services;

use Exception;

class Request 
{
    public const GET = 'get';
    
    public const POST = 'post';

    public const ALLOWED_METHODS = [
        self::GET,
        self::POST,
    ];

    /**
     * @var string $method 
     */
    private string $method = '';

    /**
     * @var string $route
     */
    private string $route = '';

    public function __construct()
    {
        $this->method = $this->initMethod();
        $this->route = $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    private function initMethod(): string
    {
        $method =  strtolower($_SERVER['REQUEST_METHOD']);

        if (in_array($method, self::ALLOWED_METHODS)) {
            return $method;
        }
        throw new \Exception('Request method is not allowed');
    }
}