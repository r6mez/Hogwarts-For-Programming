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

        // Insert user into the users table
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, type) VALUES (:name, :email, :password, 'Student')");
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $hashedPassword,
        ]);
        
        // Get the ID of the newly inserted user
        $userId = $pdo->lastInsertId(); 

        // Insert student into the students table
        $randomHouseId = rand(1, 4); // Generate a random house_id between 1 and 4
        $stmt = $pdo->prepare("INSERT INTO students (id, points, house_id) VALUES (:id, 0, :house_id)");
        $stmt->execute([
            ':id' => $userId,
            ':house_id' => $randomHouseId,
        ]);
        $userId = $pdo->lastInsertId(); 

        // Assign a random wand to the user
        $wandWoodTypes = ['Holly', 'Yew', 'Elder', 'Willow', 'Hawthorn', 'Oak'];
        $wandCores = ['Phoenix Feather', 'Dragon Heartstring', 'Unicorn Hair', 'Thestral Tail Hair'];

        $randomWood = $wandWoodTypes[array_rand($wandWoodTypes)];
        $randomCore = $wandCores[array_rand($wandCores)];

        // Insert wand into the wand table
        $stmt = $pdo->prepare("INSERT INTO wand (stud_id, woodtype, coretype) VALUES (:user_id, :wood, :core)");
        $stmt->execute([
            ':user_id' => $userId,
            ':wood' => $randomWood,
            ':core' => $randomCore,
        ]);

        header('Location: /');
        exit;
    }
}
