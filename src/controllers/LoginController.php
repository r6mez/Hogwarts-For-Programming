<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;
use App\Validators\LoginValidator;

class LoginController
{
    public function showLoginForm(array $errors = []): string
    {
        return Application::view('login', ['errors' => $errors]);
    }

    public function login(): void
    {
        $data = $_POST;
        $validator = new LoginValidator($data);
        $errors = $validator->validate();

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /login');
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $data['email']]);
        $user = $stmt->fetch();

        if ($user && password_verify($data['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        }

        $_SESSION['errors'] = ['Invalid email or password!'];
        header('Location: /login');
        exit;
    }
}
