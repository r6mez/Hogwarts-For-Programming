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
        $userId = $pdo->lastInsertId(); // Get the ID of the newly inserted user

        $randomHouseId = rand(1, 4); // Generate a random house_id between 1 and 4
        $stmt = $pdo->prepare("INSERT INTO students (id, points, house_id) VALUES (:id, 0, :house_id)");
        $stmt->execute([
            ':id' => $userId,
            ':house_id' => $randomHouseId,
        ]);

        header('Location: /');
        exit;
    }
}
