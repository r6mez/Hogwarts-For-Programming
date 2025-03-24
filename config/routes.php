<?php

use App\Core\Application;

return [
    '/' => [\App\Controllers\HomeController::class, 'home'], 
    '/profile' => [\App\Controllers\ProfileController::class, 'showProfile'],
    '/profile/edit' => [\App\Controllers\ProfileController::class, 'editProfile'],
    '/profile/edit/submit' => [\App\Controllers\ProfileController::class, 'updateProfile'],
    
    '/login' => function () { return Application::view('login', ['errors' => []]);},
    '/register' => function () { return Application::view('register', ['errors' => []]);},
    '/login/submit' => [\App\Controllers\LoginController::class, 'login'],
    '/register/submit' => [\App\Controllers\RegisterController::class, 'register'],
    '/logout' => function () {  session_destroy(); return Application::view('login', ['errors' => []]); },

    '/courses' => [\App\Controllers\CourseController::class, 'showCourses'],
    '/enroll' => [\App\Controllers\EnrollController::class, 'registerCourse'],
    '/deRegister' => [\App\Controllers\EnrollController::class, 'deRegisterCourse'],
    '/MyCourses' => [\App\Controllers\CourseController::class, 'showCoursesByStudentId'],
    '/courseSearch' => [\App\Controllers\CourseController::class, 'searchByName'],
    
    '/DiagonAlley' => [\App\Controllers\MagicalItemController::class, 'showMagicalItems'],
    '/buyItem' => [\App\Controllers\MagicalItemController::class, 'buyItem'],
    '/sellItem' => [\App\Controllers\MagicalItemController::class, 'sellItem'],
    
    '/OwlPost' => [\App\Controllers\MessageController::class, 'showChats'],
    '/chat/messages' => [\App\Controllers\MessageController::class, 'showChatMessages'],
    '/chat/send' => [\App\Controllers\MessageController::class, 'sendMessageToChat'],
    '/chat/new' => function () { $errors = $_SESSION['errors'] ?? []; unset($_SESSION['errors']); return Application::view('startNewChat', ['errors' => $errors]); },
    '/chat/create' => [\App\Controllers\MessageController::class, 'createChat'],

    '/leaderBoard' => '/leaderBoard/students',
    '/leaderBoard/students' => [\App\Controllers\leaderBoardController::class, 'showStudents'],
    '/leaderBoard/houses' => [\App\Controllers\leaderBoardController::class, 'showHouses'],

    '/quizes' => [\App\Controllers\QuizesController::class, 'getQuizzesForEnrolledCourses'],
    '/solveQuiz' => [\App\Controllers\QuizesController::class, 'solveQuiz'],
    '/submitQuiz' => [\App\Controllers\QuizesController::class, 'submitQuiz'],
    '/quizResult' => [\App\Controllers\QuizesController::class, 'viewQuizResult'],

    '/manageStudents' => [\App\Controllers\ProfessorController::class, 'manageStudents'],
    '/manageStudents/create' => [\App\Controllers\ProfessorController::class, 'createStudent'],
    '/manageStudents/edit' => [\App\Controllers\ProfessorController::class, 'editStudent'],
    '/manageStudents/delete' => [\App\Controllers\ProfessorController::class, 'deleteStudent'],

    '/manageQuizzes' => [\App\Controllers\ProfessorController::class, 'manageQuizzes'],
    '/manageQuizzes/create' => [\App\Controllers\ProfessorController::class, 'createQuiz'],
    '/manageQuizzes/edit' => [\App\Controllers\ProfessorController::class, 'editQuiz'],
    '/manageQuizzes/delete' => [\App\Controllers\ProfessorController::class, 'deleteQuiz'],

    '/manageQuestions/create' => [\App\Controllers\ProfessorController::class, 'createQuestion'],
    '/manageQuestions/edit' => [\App\Controllers\ProfessorController::class, 'editQuestion'],
    '/manageQuestions/delete' => [\App\Controllers\ProfessorController::class, 'deleteQuestion'],

    '/manageCourses' => [\App\Controllers\ProfessorController::class, 'manageCourses'],
    '/manageCourses/create' => [\App\Controllers\ProfessorController::class, 'createCourse'],
    '/manageCourses/edit' => [\App\Controllers\ProfessorController::class, 'editCourse'],
    '/manageCourses/delete' => [\App\Controllers\ProfessorController::class, 'deleteCourse'],

    '*' => function () { http_response_code(404); return Application::view('404'); },
];

