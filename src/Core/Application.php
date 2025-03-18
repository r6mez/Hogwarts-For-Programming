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
}
