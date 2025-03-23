<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;
use App\Validators\LoginValidator;

class leaderBoardController
{
    public function showStudents(): string
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT u.name , s.points , u.email , h.name as house
                                from students s join users u
                                on s.id = u.id
                                join houses h on h.id = s.house_id
                                order by points desc");
        $stmt->execute();
        $students = $stmt->fetchAll();

        return Application::view('leaderStudent', ['students' => $students]);
    }

    public function showHouses(): string
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT h.name , sum(s.points) as points
                                from students s join houses h
                                on s.house_id = h.id
                                group by h.name
                                order by points desc");
        $stmt->execute();
        $houses = $stmt->fetchAll();

        return Application::view('leaderHouse', ['houses' => $houses]);
    }
}