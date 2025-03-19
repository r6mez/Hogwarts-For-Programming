<?php
namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;

class CourseController
{
    public function showCourses(): string
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("select c.id , c.name , u.name as professor
                            from professors p right join course c
                            on p.id = c.id_prof 
                            left join users u on p.id = u.id; ");
        $course = $stmt->fetchAll();

        return Application::view('course', ['course' => $course]);
    }

    public function showCourse(int $id): string
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM course WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $course = $stmt->fetch();

        return Application::view('course', ['course' => $course]);
    }
}

