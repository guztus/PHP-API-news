<?php

namespace App;
use App\Controllers\ErrorController;
use FastRoute;

class Router
{
    public static function route($twig)
    {
        // Routing
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
            $route->addRoute('GET', '/', ['App\Controllers\MainController', 'index']);
            $route->addRoute('GET', '/about', ['App\Controllers\AboutController', 'index']);
            $route->addRoute('GET', '/articles', ['App\Controllers\ArticleController', 'index']);
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
                return (new ErrorController())->index($twig->getTwig(), '404');
                // ... 404 Not Found

            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                return (new ErrorController())->index($twig->getTwig(), '405');
                // ... 405 Method Not Allowed

            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                [$controller, $method] = $handler;
                return (new $controller)->{$method}($twig->getTwig());
        }
    }
}