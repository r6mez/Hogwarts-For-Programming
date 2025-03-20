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

    
    public static function showCoursesByStudentId(): string
    {
        $pdo = Database::getInstance();
        
        $stmt = $pdo->prepare("SELECT c.id , c.name
                                FROM students s JOIN enroll e
                                ON s.id = e.id_stud
                                JOIN course c ON c.id = e.id_cour
                                WHERE s.id = :id");
        $stmt->execute([':id' => $_SESSION['user']['id']]);
        $Mycourse = $stmt->fetchAll();
        
        return Application::view('MyCourses', ['Mycourse' => $Mycourse]); 
    }
    public function searchById(){
        $data = $_GET;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT c.id , c.name , u.name as professor
                                FROM professors p right join course c
                                on p.id = c.id_prof 
                                left join users u on p.id = u.id
                                WHERE c.id = :id");
        $stmt->execute([':id' => $data['SearchId']]);
        $course = $stmt->fetchAll();
        return Application::view('course', ['course' => $course]);
    }
}

