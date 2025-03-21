<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;

class EnrollController {
    public function registerCourse(): void
    {
        $data = $_POST;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM enroll WHERE id_stud = :student_id AND id_cour = :course_id");
        $stmt->execute([
            ':student_id' => $_SESSION['user']['id'],
            ':course_id' => $data['course_id']
        ]);
        $count = $stmt->fetchColumn(); // Get count of existing rows

        if ($count > 0) {
            $_SESSION['errors'][$data['course_id']] = "You are already enrolled in this course!";
            header('Location: /course');
            exit;
        }else{
            $stmt = $pdo->prepare("INSERT INTO enroll (id_stud, id_cour) VALUES (:student_id, :course_id)");
            $stmt->execute([
                ':student_id' => $_SESSION['user']['id'],
                ':course_id' => $data['course_id']
            ]);

            header('Location: /courses');
            exit;
        }

        
    }
    public function deRegisterCourse(): void
    {
        $data = $_POST;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM enroll WHERE id_stud = :student_id AND id_cour = :course_id");
        $stmt->execute([
            ':student_id' => $_SESSION['user']['id'],
            ':course_id' => $data['course_id']
        ]);

        header('Location: /MyCourses');
        exit;
    }

    
}