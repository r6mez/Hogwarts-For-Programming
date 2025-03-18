<?php

namespace App\Core;

class Router
{
    protected array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function resolve(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $route = $this->routes[$path] ?? null;

        if (is_string($route)) {
            return $route; // Return static content
        }

        if (is_array($route) && count($route) === 2) {
            [$controller, $method] = $route;
            if (class_exists($controller) && method_exists($controller, $method)) {
                $controllerInstance = new $controller();
                return $controllerInstance->$method(); // Call the controller method
            }
        }

        return '404 - Page Not Found'; // Default response for undefined routes
    }
}
