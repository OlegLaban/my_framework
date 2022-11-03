<?php
namespace App\Services;

use App\Services\Interfaces\RequestInterface;

class Request implements RequestInterface
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

    public function __construct(array $serverParams)
    {
        $this->method = $this->initMethod($serverParams);
        $this->route = $serverParams['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getRoute(): string
    {
        return preg_replace('/\/$/', '', $this->route);
    }

    private function initMethod(array $serverParams): string
    {
        $method = strtolower($serverParams['REQUEST_METHOD']);

        if (in_array($method, self::ALLOWED_METHODS)) {
            return $method;
        }
        throw new \Exception('Request method is not allowed');
    }
}
