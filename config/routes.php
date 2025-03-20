<?php

use App\Core\Application;

return [
    '/' => 'home', 
    '/about' => 'about', 
    '/login' => function () { return Application::view('login', ['errors' => []]);},
    '/register' => function () { return Application::view('register', ['errors' => []]);},
    '/login/submit' => [\App\Controllers\LoginController::class, 'login'],
    '/register/submit' => [\App\Controllers\RegisterController::class, 'register'],
    '/course' => [\App\Controllers\CourseController::class, 'showCourses'],
    '/enroll' => [\App\Controllers\EnrollController::class, 'registerCourse'],
    '/MyCourses' => [\App\Controllers\CourseController::class, 'showCoursesByStudentId'],
    '/courseSearch' => [\App\Controllers\CourseController::class, 'searchById'],
    '/logout' => function () {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
];
