<?php

namespace App\Controllers;

use App\Core\Database;

class ProfessorController
{
    public function getProfessorByID($id): array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT u.name, u.email, p.experience
                               FROM users u
                               LEFT JOIN professors p ON u.id = p.id
                               WHERE u.id = :id");
        $stmt->execute([':id' => $id]);
        $professor = $stmt->fetch();
        return $professor;
    }
}
