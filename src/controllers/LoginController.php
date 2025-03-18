<?php

namespace App\Controllers;

use App\Core\Database;

class LoginController
{
    public function showLoginForm(): string
    {
        return file_get_contents(__DIR__ . '/../views/login.php');
    }

    public function login(): string
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$email || !$password) {
            return 'Email and password are required!';
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        }

        return 'Invalid email or password!';
    }
}
