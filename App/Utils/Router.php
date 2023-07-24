<?php
namespace App\Utils;

use App\Utils\Response;

class Router
{
    private static $instance = null;
    private static $routes = [];
    private static $currentRoutePath = '';
    private static $currentRouteMethod = '';

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstance()
    {
        if (self::$instance === null) 
        {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    public static function get($path, $handler)
    {
        self::assignHandler($path, $handler, 'GET');
        return self::getInstance();   
    }

    public static function post($path, $handler)
    {
        self::assignHandler($path, $handler, 'POST');
        return self::getInstance();   
    }

    public static function put($path, $handler)
    {
        self::assignHandler($path, $handler, 'PUT');
        return self::getInstance();   
    }

    public static function view($path, $fileName)
    {
        $handler = fn() => HtmlResponse::make($fileName);
        self::assignHandler($path, $handler, 'GET');
        return self::getInstance();
    }

    public static function assignMiddleware($middleware)
    {
        $currentRoute = self::$routes[ self::$currentRoutePath ][ self::$currentRouteMethod ];
        $currentRoute->assignMiddleware($middleware);
        self::$routes[ self::$currentRoutePath ][ self::$currentRouteMethod ] = $currentRoute;

        return self::getInstance();   
    }

    public static function assignMiddlewares($middlewares)
    {
        foreach ($middlewares as $middleware) 
        {
            self::assignMiddleware($middleware);
        }

        return self::getInstance();
    }

    public static function route($uri)
    {
        $path = strtok($uri, '?');
        if (! isset(self::$routes[ $path ])) 
        {
            Response::make(404, 'Not found')->send();
        }

        $isMethodAllowed = isset(self::$routes[ $path ][ $_SERVER[ 'REQUEST_METHOD' ] ]);
        if (!$isMethodAllowed) 
        {
            return Response::make(405, 'Method not allowed');
        }

        $route = self::$routes[ $path ][ $_SERVER[ 'REQUEST_METHOD' ] ];
        $response = $route->executeHandler();

        $middlewares = array_reverse($route->getMiddlewares());
        $response    = Pipeline::make()->through($middlewares)->send($response)->thenReturn();

        $response->send();
    }


    private static function assignHandler($path, $handler, $method)
    {
        self::$currentRoutePath = $path;
        self::$currentRouteMethod = $method;
        self::$routes[ $path ][ $method ]  = new Route($handler, $method);
    }
}