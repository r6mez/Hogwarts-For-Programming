<?php
namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;

class QuizesController {
    public function getQuizzesForEnrolledCourses() {
        $studentId = $_SESSION['student']['id'];
        $db = Database::getInstance();
        $query = "
            SELECT q.id, q.score, c.name AS course_name,
                   EXISTS (
                       SELECT 1 FROM studentAnswer sa
                       JOIN question qu ON sa.question_id = qu.id
                       WHERE sa.student_id = :studentId AND qu.quiz_id = q.id
                   ) AS taken
            FROM quiz q
            INNER JOIN course c ON q.id_cour = c.id
            INNER JOIN enroll e ON e.id_cour = c.id
            WHERE e.id_stud = :studentId
        ";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, \PDO::PARAM_INT);
        $stmt->execute();
        $quizzes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return Application::view('quizes', ['quizzes' => $quizzes]);
    }

    public function solveQuiz() {
        $quizId = $_POST['quiz_id'];
        $studentId = $_SESSION['student']['id'];

        $db = Database::getInstance();

        $checkQuery = "SELECT COUNT(*) FROM studentAnswer WHERE student_id = :studentId AND question_id IN (SELECT id FROM question WHERE quiz_id = :quizId)";
        $stmt = $db->prepare($checkQuery);
        $stmt->bindParam(':studentId', $studentId, \PDO::PARAM_INT);
        $stmt->bindParam(':quizId', $quizId, \PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            return Application::view('quizResult', ['error' => 'You have already taken this quiz.']);
        }

        $query = "SELECT id, body FROM question WHERE quiz_id = :quizId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':quizId', $quizId, \PDO::PARAM_INT);
        $stmt->execute();
        $questions = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return Application::view('solveQuiz', ['questions' => $questions, 'quiz_id' => $quizId]);
    }

    public function submitQuiz() {
        $studentId = $_SESSION['student']['id'];
        $quizId = $_POST['quiz_id'];
        $answers = $_POST['answers'];

        $db = Database::getInstance();

        // Fetch correct answers for the quiz
        $query = "SELECT id, answer FROM question WHERE quiz_id = :quizId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':quizId', $quizId, \PDO::PARAM_INT);
        $stmt->execute();
        $questions = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $correctAnswers = 0;
        $totalQuestions = count($questions);

        foreach ($questions as $question) {
            $questionId = $question['id'];
            $correctAnswer = $question['answer'];
            $studentAnswer = isset($answers[$questionId]) ? (bool)$answers[$questionId] : false;

            if ($studentAnswer === (bool)$correctAnswer) {
                $correctAnswers++;
            }

            $query = "INSERT INTO studentAnswer (student_id, question_id, answer) VALUES (:studentId, :questionId, :answer)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':studentId', $studentId, \PDO::PARAM_INT);
            $stmt->bindParam(':questionId', $questionId, \PDO::PARAM_INT);
            $stmt->bindParam(':answer', $studentAnswer, \PDO::PARAM_BOOL);
            $stmt->execute();
        }

        $query = "SELECT score FROM quiz WHERE id = :quizId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':quizId', $quizId, \PDO::PARAM_INT);
        $stmt->execute();
        $quizScore = $stmt->fetchColumn();

        $awardedPoints = round(($correctAnswers / $totalQuestions) * $quizScore);

        $query = "UPDATE students SET points = points + :points WHERE id = :studentId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':points', $awardedPoints, \PDO::PARAM_INT);
        $stmt->bindParam(':studentId', $studentId, \PDO::PARAM_INT);
        $stmt->execute();

        header("Location: /quizResult?quiz_id=$quizId&points=$awardedPoints");
        exit;
    }

    public function viewQuizResult() {
        $quizId = $_GET['quiz_id'];
        $studentId = $_SESSION['student']['id'];

        $db = Database::getInstance();

        $query = "
            SELECT q.body, q.answer AS correct_answer, sa.answer AS student_answer
            FROM question q
            LEFT JOIN studentAnswer sa ON q.id = sa.question_id AND sa.student_id = :studentId
            WHERE q.quiz_id = :quizId
        ";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':studentId', $studentId, \PDO::PARAM_INT);
        $stmt->bindParam(':quizId', $quizId, \PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $correctAnswers = 0;
        $totalQuestions = count($results);

        foreach ($results as $result) {
            if ((bool)$result['student_answer'] === (bool)$result['correct_answer']) {
                $correctAnswers++;
            }
        }

        $query = "SELECT score FROM quiz WHERE id = :quizId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':quizId', $quizId, \PDO::PARAM_INT);
        $stmt->execute();
        $quizScore = $stmt->fetchColumn();

        $awardedPoints = round(($correctAnswers / $totalQuestions) * $quizScore);

        return Application::view('quizResult', ['results' => $results, 'awardedPoints' => $awardedPoints]);
    }
}
