<?php
namespace App\Controllers;
use App\Core\Database;
use App\Validators\CourseValidator;
class CourseController 
{
    public function index(): void 
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM course");
        $courses = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        require_once __DIR__ . '/../views/course/index.php';
    }
    public function create(): void 
    {
        $data = $_POST;
        $validator = new CourseValidator($data);
        $errors = $validator->validate();
        if (!empty($errors))
        {
            $_SESSION['errors'] = $errors;
            header('Location: /courses');
            exit;
        }
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("insert into course (name, id_prof) values (:name, :id_prof)");
        $stmt->execute([
            ':name' => $data['name'],
            ':id_prof' => $data['id_prof'],
        ]);
        header('Location: /courses');
        exit;
    }
    public function delete(int $id): void 
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("delete from  course where id = :id");
        $stmt->execute([':id' => $id]);
        header('Location: /courses');
        exit;
    }
}