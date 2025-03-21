<?php

namespace App\Core;

use App\Core\Application;

class Router
{
    protected array $routes;

    public function __construct(array $routes)
    {
        session_start(); // Start session for error handling
        $this->routes = $routes;
    }

    public function resolve(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH);

        // Redirect unauthenticated users to login page
        $publicRoutes = ['/login', '/register', '/login/submit', '/register/submit' ,'/course'];
        if (!isset($_SESSION['user']) && !in_array($path, $publicRoutes)) {
            header('Location: /login');
            exit;
        }

        $route = $this->routes[$path] ?? null;

        if (is_string($route)) {
            return Application::view($route); // Render static content using the view function
        }

        if (is_callable($route)) {
            return $route(); // Execute closure for dynamic content
        }

        if (is_array($route) && count($route) === 2) {
            [$controller, $method] = $route;
            if (class_exists($controller) && method_exists($controller, $method)) {
                $controllerInstance = new $controller();
                return $controllerInstance->$method(); // Call the controller method
            }
        }

        return Application::view('404', ['message' => 'Page Not Found']); // Render a 404 view
    }
}
