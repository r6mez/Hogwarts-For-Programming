<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;
use App\Validators\RegisterValidator;

class RegisterController
{
    public function register(): void
    {
        $data = $_POST;
        $validator = new RegisterValidator($data);
        $errors = $validator->validate();

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: /register');
            exit;
        }

        $pdo = Database::getInstance();
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, type) VALUES (:name, :email, :password, 'Student')");
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $hashedPassword,
        ]);

        header('Location: /');
        exit;
    }
}
