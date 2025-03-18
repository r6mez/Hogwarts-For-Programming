<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;
use App\Validators\RegisterValidator;

class RegisterController
{
    public function showRegisterForm(array $errors = []): string
    {
        return Application::view('register', ['errors' => $errors]);
    }

    public function register(): string
    {
        $request = new RegisterValidator($_POST);
        $errors = $request->validate();

        if (!empty($errors)) {
            return Application::view('register', ['errors' => $errors]);
        }

        $pdo = Database::getInstance();
        $hashedPassword = password_hash($request->get('password'), PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, type) VALUES (:name, :email, :password, 'Student')");
        $stmt->execute([
            ':name' => $request->get('name'),
            ':email' => $request->get('email'),
            ':password' => $hashedPassword,
        ]);

        header('Location: /');
        exit;
    }
}
