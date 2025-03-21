<?php

use App\Core\Application;

return [
    '/' => 'home', 
    
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

];
