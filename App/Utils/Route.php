<?php

namespace App\Utils;

use App\Middlewares\Middleware;

class Route
{
    public $handler;

    public string $method;

    protected array $middlewares;

    public function __construct($handler, $method = 'GET', $middlewares = []) 
    {
        $this->handler = $handler;
        $this->method  = $method;
        $this->middlewares = $middlewares;
    }

    public function assignMiddleware($middleware)
    {
        if (! class_exists($middleware)) 
        {
            throw new \Exception('Middleware not implementing interface', 500);
        }

        $isMiddleware = in_array(Middleware::class, class_implements($middleware));
        if (! $isMiddleware) 
        {
            throw new \Exception('Middleware not implementing interface', 500);
        }
        
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    public function executeHandler()
    {
        try {
            $request = Pipeline::make()->through($this->middlewares)->send($_REQUEST)->thenReturn();
            $res     = $this->callHandlerByType($this->handler, $request);    
        } catch (\Exception $ex) {
            return Response::make($ex->getCode(), $ex->getMessage());
        }

        return $res;
    }

    private static function callHandlerByType($handler, $request)
    {
        if (is_array($handler)) 
        {
            $handlerInstance = new $handler[0]();
            return $handlerInstance->{$handler[1]}($request);
        }

        return $handler($request);
    }
}