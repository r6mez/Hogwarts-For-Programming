<?php

namespace App\Controllers;

use App\Core\Application;
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

    public function manageStudents()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT s.id, u.name, u.email, s.points, h.name AS house FROM students s JOIN users u ON s.id = u.id JOIN houses h ON s.house_id = h.id");
        $students = $stmt->fetchAll();
        return Application::view('manageStudents', ['students' => $students]);
    }

    public function createStudent()
    {
        $this->authorizeProfessor();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, type) VALUES (:name, :email, :password, 'Student')");
            $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            ]);
            $userId = $pdo->lastInsertId();
            $stmt = $pdo->prepare("INSERT INTO students (id, points, house_id) VALUES (:id, :points, :house_id)");
            $stmt->execute([
                ':id' => $userId,
                ':points' => $_POST['points'],
                ':house_id' => $_POST['house_id'],
            ]);
            header('Location: /manageStudents');
            exit;
        }
        $pdo = Database::getInstance();
        $houses = $pdo->query("SELECT id, name FROM houses")->fetchAll();
        return Application::view('createStudent', ['houses' => $houses]);
    }

    public function editStudent()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
            $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':id' => $_POST['id'],
            ]);
            $stmt = $pdo->prepare("UPDATE students SET points = :points, house_id = :house_id WHERE id = :id");
            $stmt->execute([
                ':points' => $_POST['points'],
                ':house_id' => $_POST['house_id'],
                ':id' => $_POST['id'],
            ]);
            header('Location: /manageStudents');
            exit;
        }
        $stmt = $pdo->prepare("SELECT u.id, u.name, u.email, s.points, s.house_id FROM users u JOIN students s ON u.id = s.id WHERE u.id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $student = $stmt->fetch();
        $houses = $pdo->query("SELECT id, name FROM houses")->fetchAll();
        return Application::view('editStudent', ['student' => $student, 'houses' => $houses]);
    }

    public function deleteStudent()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();

        // Delete related rows in the wand table
        $stmt = $pdo->prepare("DELETE FROM wand WHERE stud_id = :id");
        $stmt->execute([':id' => $_GET['id']]);

        // Delete related rows in the enroll table
        $stmt = $pdo->prepare("DELETE FROM enroll WHERE id_stud = :id");
        $stmt->execute([':id' => $_GET['id']]);

        // Delete related rows in the MagicalItem table
        $stmt = $pdo->prepare("DELETE FROM MagicalItem WHERE stud_id = :id");
        $stmt->execute([':id' => $_GET['id']]);

        // Delete the student from the users table
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);

        header('Location: /manageStudents');
        exit;
    }

    public function manageQuizzes()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT q.id, q.score, c.name AS course FROM quiz q JOIN course c ON q.id_cour = c.id");
        $quizzes = $stmt->fetchAll();
        return Application::view('manageQuizzes', ['quizzes' => $quizzes]);
    }

    public function createQuiz()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("INSERT INTO quiz (id_cour, score) VALUES (:id_cour, :score)");
            $stmt->execute([
                ':id_cour' => $_POST['id_cour'],
                ':score' => $_POST['score'],
            ]);
            $quizId = $pdo->lastInsertId();
            header('Location: /manageQuizzes/create?id=' . $quizId);
            exit;
        }

        $courses = $pdo->query("SELECT id, name FROM course")->fetchAll();

        // Fetch questions if a quiz ID is provided
        $questions = [];
        $quizId = $_GET['id'] ?? null;
        if ($quizId) {
            $stmt = $pdo->prepare("SELECT id, body, answer FROM question WHERE quiz_id = :quiz_id");
            $stmt->execute([':quiz_id' => $quizId]);
            $questions = $stmt->fetchAll();
        }

        return Application::view('createQuiz', [
            'courses' => $courses,
            'questions' => $questions,
            'quiz_id' => $quizId,
        ]);
    }

    public function editQuiz()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("UPDATE quiz SET id_cour = :id_cour, score = :score WHERE id = :id");
            $stmt->execute([
                ':id_cour' => $_POST['id_cour'],
                ':score' => $_POST['score'],
                ':id' => $_POST['id'],
            ]);
            header('Location: /manageQuizzes');
            exit;
        }
        $stmt = $pdo->prepare("SELECT * FROM quiz WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $quiz = $stmt->fetch();
        $courses = $pdo->query("SELECT id, name FROM course")->fetchAll();

        // Fetch questions for the quiz
        $stmt = $pdo->prepare("SELECT id, body, answer FROM question WHERE quiz_id = :quiz_id");
        $stmt->execute([':quiz_id' => $quiz['id']]);
        $questions = $stmt->fetchAll();

        return Application::view('editQuiz', [
            'quiz' => $quiz,
            'courses' => $courses,
            'questions' => $questions,
        ]);
    }

    public function deleteQuiz()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM quiz WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        header('Location: /manageQuizzes');
        exit;
    }

    public function createQuestion()
    {
        $this->authorizeProfessor();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("INSERT INTO question (body, answer, quiz_id) VALUES (:body, :answer, :quiz_id)");
            $stmt->execute([
                ':body' => $_POST['body'],
                ':answer' => $_POST['answer'],
                ':quiz_id' => $_POST['quiz_id'],
            ]);
            header('Location: /manageQuizzes/create?id=' . $_POST['quiz_id']);
            exit;
        }
    }

    public function editQuestion()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("UPDATE question SET body = :body, answer = :answer WHERE id = :id");
            $stmt->execute([
                ':body' => $_POST['body'],
                ':answer' => $_POST['answer'],
                ':id' => $_POST['id'],
            ]);
            header('Location: /manageQuizzes/create?id=' . $_POST['quiz_id']);
            exit;
        }
        $stmt = $pdo->prepare("SELECT * FROM question WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $question = $stmt->fetch();
        return Application::view('editQuestion', ['question' => $question]);
    }

    public function deleteQuestion()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM question WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        header('Location: /manageQuizzes/edit?id=' . $_GET['quiz_id']);
        exit;
    }

    public function manageCourses()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        $stmt = $pdo->query("
            SELECT c.id, c.name, 
                   COALESCE(u.name, 'Unassigned') AS professor 
            FROM course c 
            LEFT JOIN users u ON c.id_prof = u.id
        ");
        $courses = $stmt->fetchAll();
        return Application::view('manageCourses', ['courses' => $courses]);
    }

    public function createCourse()
    {
        $this->authorizeProfessor();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("INSERT INTO course (name, id_prof) VALUES (:name, :id_prof)");
            $stmt->execute([
                ':name' => $_POST['name'],
                ':id_prof' => $_POST['id_prof'],
            ]);
            header('Location: /manageCourses');
            exit;
        }
        $pdo = Database::getInstance();
        $professors = $pdo->query("SELECT id, name FROM users WHERE type = 'Professor'")->fetchAll();
        return Application::view('createCourse', ['professors' => $professors]);
    }

    public function editCourse()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $pdo->prepare("UPDATE course SET name = :name, id_prof = :id_prof WHERE id = :id");
            $stmt->execute([
                ':name' => $_POST['name'],
                ':id_prof' => $_POST['id_prof'],
                ':id' => $_POST['id'],
            ]);
            header('Location: /manageCourses');
            exit;
        }
        $stmt = $pdo->prepare("SELECT * FROM course WHERE id = :id");
        $stmt->execute([':id' => $_GET['id']]);
        $course = $stmt->fetch();
        $professors = $pdo->query("SELECT id, name FROM users WHERE type = 'Professor'")->fetchAll();
        return Application::view('editCourse', ['course' => $course, 'professors' => $professors]);
    }

    public function deleteCourse()
    {
        $this->authorizeProfessor();
        $pdo = Database::getInstance();
        try {
            $stmt = $pdo->prepare("DELETE FROM course WHERE id = :id");
            $stmt->execute([':id' => $_GET['id']]);
        } catch (\PDOException $e) {
            $_SESSION['errors'] = ['Cannot delete course. It may have related quizzes or enrollments.'];
        }
        header('Location: /manageCourses');
        exit;
    }

    private function authorizeProfessor()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'Professor') {
            header('Location: /');
            exit;
        }
    }
}
