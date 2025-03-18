<?php

use App\Core\Application;

return [
    '/' => 'home', 
    '/about' => 'about', 
    '/login' => [\App\Controllers\LoginController::class, 'showLoginForm'],
    '/register' => function () { return Application::view('register', ['errors' => []]);},
    '/login/submit' => [\App\Controllers\LoginController::class, 'login'],
    '/register/submit' => [\App\Controllers\RegisterController::class, 'register'],
];
