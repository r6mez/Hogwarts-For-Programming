<?php

namespace App\Controllers;

use App\Controllers\StudentController;
use App\Controllers\ProfessorController;
use App\Core\Application;

class ProfileController
{
    public function showProfile()
    {
        $user = $_SESSION['user'];

        if ($user['type'] == 'Student') {
            $studentController = new StudentController();
            $student = $studentController->getStudentByID($user['id']);
            $user['points'] = $student['points'];
            $user['house'] = $student['house'];
        } else if ($user['type'] == 'Professor') {
            $professorController = new ProfessorController();
            $professor = $professorController->getProfessorByID($user['id']);
            $user['experience'] = $professor['experience'];
        }

        return Application::view('profile', ['user' => $user]);
    }

    public function editProfile()
    {
        $user = $_SESSION['user'];
        return Application::view('profileEdit', ['user' => $user]);
    }

    public function updateProfile()
    {
        $pdo = \App\Core\Database::getInstance();
        $userId = $_SESSION['user']['id'];
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $experience = isset($_POST['experience']) ? trim($_POST['experience']) : null;

        $errors = [];
        if (empty($name) || empty($email)) {
            $errors[] = "Name and email are required.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: /profile/edit");
            exit;
        }

        $query = "UPDATE users SET name = :name, email = :email";
        $params = [':name' => $name, ':email' => $email, ':id' => $userId];

        $query .= " WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        if ($_SESSION['user']['type'] === 'Professor' && $experience !== null) {
            $stmt = $pdo->prepare("UPDATE professors SET experience = :experience WHERE id = :id");
            $stmt->execute([':experience' => $experience, ':id' => $userId]);
            $_SESSION['user']['experience'] = $experience;
        }

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;

        header("Location: /profile");
        exit;
    }
}
