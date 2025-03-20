<?php
namespace App\Controllers;
use App\Core\Database;
use App\Validators\QuizValidator;

class QuizController 
{
    public function index(): void 
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM quiz");
        $quizzes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        require_once __DIR__ . '/../views/quiz/index.php';
    }
    public function create(): void 
    {
        $data = $_POST;
        $validator = new QuizValidator($data);
        $errors = $validator->validate();
        if (!empty($errors)) 
        {
            $_SESSION['errors'] = $errors;
            header('Location: /quizzes');
            exit;
        }
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("insert into quiz (id_cour, id_prof, id_stud, score) values (:id_cour, :id_prof, :id_stud, :score)");
        $stmt->execute([
            ':id_cour' => $data['id_cour'],
            ':id_prof' => $data['id_prof'],
            ':id_stud' => $data['id_stud'],
            ':score' => $data['score'],
        ]);
        header('Location: /quizzes');
        exit;
    }
    public function delete(int $id): void 
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("delete from quiz where id = :id");
        $stmt->execute([':id' => $id]);

        header('Location: /quizzes');
        exit;
    }
}