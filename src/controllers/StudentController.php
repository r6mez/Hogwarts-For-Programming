<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;

class StudentController
{
    public function getStudentByID($id): array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT u.name, u.email, s.points, h.name as house
                               FROM users u
                               LEFT JOIN students s ON u.id = s.id
                               LEFT JOIN Houses h ON s.house_id = h.id
                               WHERE u.id = :id");
        $stmt->execute([':id' => $id]);
        $student = $stmt->fetch();
        return $student;
    }
}
