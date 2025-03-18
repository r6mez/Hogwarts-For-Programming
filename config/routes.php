<?php

return [
    '/' => 'Welcome to Hogwarts for Programming!',
    '/about' => 'About Hogwarts for Programming',
    '/login' => [\App\Controllers\LoginController::class, 'showLoginForm'],
    '/register' => [\App\Controllers\RegisterController::class, 'showRegisterForm'],
    '/login/submit' => [\App\Controllers\LoginController::class, 'login'],
    '/register/submit' => [\App\Controllers\RegisterController::class, 'register'],
];
