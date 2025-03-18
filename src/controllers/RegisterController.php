<?php

namespace App\Controllers;

class RegisterController
{
    public function showRegisterForm(): string
    {
        return file_get_contents(__DIR__ . '/../views/register.php');
    }

    public function register(): string
    {
        // Handle registration logic here
        return 'Registration successful!';
    }
}
