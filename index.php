<?php

require_once 'vendor/autoload.php';

use jcobhams\NewsApi\NewsApi;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// API KEY
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$newsApi = new NewsApi($_ENV['APIKEY']);

// Twig
$loader = new FilesystemLoader('views');
$twig = new Environment($loader, [
    'cache' => 'cache',
    'auto_reload' => true, // Make true only when coding
]);

if (!$_GET) {
    $_GET['search'] = 'World';
}

// Routing
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', ['jcobhams\NewsApi\Controllers\ArticleController', 'index']);
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

        return (new $controller)->{$method}($twig, $newsApi); // , $newsApi
}
