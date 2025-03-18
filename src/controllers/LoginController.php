<?php

namespace App\Controllers;

class LoginController
{
    public function showLoginForm(): string
    {
        return file_get_contents(__DIR__ . '/../views/login.php');
    }

    public function login(): string
    {
        // Handle login logic here
        return 'Login successful!';
    }
}
