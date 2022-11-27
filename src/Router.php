<?php

namespace jcobhams\NewsApi;
use FastRoute;

class Router
{
    public static function route($twig)
    {
        // Routing
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
            $route->addRoute('GET', '/', ['jcobhams\NewsApi\Controllers\MainController', 'index']);
            $route->addRoute('GET', '/about', ['jcobhams\NewsApi\Controllers\AboutController', 'index']);
            $route->addRoute('GET', '/articles/', ['jcobhams\NewsApi\Controllers\ArticleController', 'index']);
        });

// Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                var_dump('404 Not Found');
                // ... 404 Not Found
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                var_dump('405 Method Not Allowed');
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                [$controller, $method] = $handler;
                return (new $controller)->{$method}($twig->getTwig());
        }
    }
}