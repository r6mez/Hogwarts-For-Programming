<?php

namespace App\Core;

class Application
{
    protected Router $router;

    public function __construct()
    {
        $this->router = new Router(require __DIR__ . '/../../config/routes.php');
    }

    public function run()
    {
        echo $this->router->resolve($_SERVER['REQUEST_URI']);
    }

    static function view(string $viewName, array $data = []): string
    {
        extract($data); // Extracts array keys as variables
        ob_start();
        include __DIR__ . "/../views/{$viewName}.view.php"; // Includes the view file
        return ob_get_clean();
    }
}
