<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;

class HomeController {
    public function fetchHousesRank(): array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT h.name , sum(s.points) as points
                                from students s join houses h
                                on s.house_id = h.id
                                group by h.name
                                order by points desc");
        $stmt->execute();
        $houses = $stmt->fetchAll();
        return $houses;
    }

    public function getQuizzesForEnrolledCourses() {
        if($_SESSION['user']['type'] === 'Professor') {
            return [];
        }
        $studentId = $_SESSION['student']['id'];
        $db = Database::getInstance();
        $query = "
            SELECT q.id, q.score, c.name AS course_name
            FROM quiz q
            INNER JOIN course c ON q.id_cour = c.id
            INNER JOIN enroll e ON e.id_cour = c.id
            WHERE e.id_stud = :studentId
              AND Not EXISTS (
                  SELECT 1 FROM studentAnswer sa
                  JOIN question qu ON sa.question_id = qu.id
                  WHERE sa.student_id = :studentId AND qu.quiz_id = q.id
              )
        ";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, \PDO::PARAM_INT);
        $stmt->execute();
        $quizzes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $quizzes;
    }

    public function home(): string
    {
        $houses = $this->fetchHousesRank();
        $quizzes = $this->getQuizzesForEnrolledCourses();
        $user = $_SESSION['user']; // Add this line to retrieve the user data
        $studentController = new StudentController();
        $student = $studentController->getStudentByID($user['id']);
        $user['points'] = $student['points']; // override the points value
        return Application::view('home', ['houses' => $houses, 'quizzes' => $quizzes, 'user' => $user]);
    }
}