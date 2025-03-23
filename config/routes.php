<?php

use App\Core\Application;

return [
    '/' => 'home', 
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
    
    '/OwlPost' => [\App\Controllers\MessageController::class, 'showReceivedMessage'],
    '/message' => [\App\Controllers\MessageController::class, 'showMessage'],
    '/message/send' => [\App\Controllers\MessageController::class, 'SendMessage'],
    '/message/send/submit' => [\App\Controllers\MessageController::class, 'SendMessageSubmit'],
    '/message/delete' => [\App\Controllers\MessageController::class, 'deleteMessage'],

    '/leaderBoard' => '/leaderBoard/students',
    '/leaderBoard/students' => [\App\Controllers\leaderBoardController::class, 'showStudents'],
    '/leaderBoard/houses' => [\App\Controllers\leaderBoardController::class, 'showHouses'],
    
 
];
