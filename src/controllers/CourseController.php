<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;

class CourseController
{
    public function showCourses(): string
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT c.id , c.name , u.name as professor
                                from professors p right join course c
                                on p.id = c.id_prof 
                                left join users u on p.id = u.id
                                where not EXISTS (select 1 
                                from enroll e
                                where e.id_stud = :id and e.id_cour = c.id )");
        $stmt->execute([':id' => $_SESSION['user']['id']]);
        $course = $stmt->fetchAll();
        return Application::view('courses', ['course' => $course]);
    }

    public static function showCoursesByStudentId(): string
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT c.id , c.name , u.name as professor
                                from professors p right join course c
                                on p.id = c.id_prof 
                                left join users u on p.id = u.id
                                where  EXISTS (select 1 
                                from enroll e
                                where e.id_stud = :id and e.id_cour = c.id)");
        $stmt->execute([':id' => $_SESSION['user']['id']]);
        $Mycourse = $stmt->fetchAll();

        return Application::view('MyCourses', ['Mycourse' => $Mycourse]);
    }

    public function searchByName()
    {
        $data = $_GET;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT c.id , c.name , u.name as professor
                                FROM professors p right join course c
                                on p.id = c.id_prof 
                                left join users u on p.id = u.id
                                WHERE c.name like :char ");
        $stmt->execute([':char' => $data['SearchName'] . '%']);
        $course = $stmt->fetchAll();
        return Application::view('courses', ['course' => $course]);
    }
}
