<?php
/**
 * Created by PhpStorm.
 * User: Георгий
 * Date: 03.11.2019
 * Time: 14:39
 */

namespace app\core;

use FastRoute;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/site/home', 'site/home');
    $r->addRoute('GET', '/site/signup', 'site/signup');
    $r->addRoute('GET', '/site/signin', 'site/signin');
    $r->addRoute('GET', '/site/account/{id:\d+}', 'site/account');
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
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode("/", $handler, 2);
        $class = 'app\controllers\\' . ucfirst($class) . 'Controller';
        $method = 'action' . ucfirst($method);
        call_user_func_array(array( $class, $method), $vars);
        break;
}