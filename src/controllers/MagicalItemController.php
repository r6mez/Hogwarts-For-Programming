<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\Application;

class MagicalItemController {
    public static function showMagicalItems() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT id ,price , type , imag from magicalitem where stud_id is null;");
        $stmt->execute();
        $items = $stmt->fetchAll();
        return Application::view('DiagonAlley', ['items' => $items]);
    }

    public static function buyItem() {
        $data = $_POST;
        $pdo = Database::getInstance();
        
        if($_SESSION['student']['points'] < $data['item_price']) {
            $_SESSION['errors'][$data['item_id']] = 'You do not have enough points to buy this item!';
            header('Location: /DiagonAlley');
            exit;
        } else {
            $_SESSION['student']['points'] -= $data['item_price'];
            $stmt = $pdo->prepare("UPDATE  students 
                                set points = points - :price
                                where id = :id;"); 
                                
            $stmt->execute([':id' => $_SESSION['user']['id'] , ':price' => $data['item_price']]);
            $stmt = $pdo->prepare("UPDATE  magicalitem 
                                set stud_id = :id
                                where id = :item_id;");

            $stmt->execute([':id' => $_SESSION['user']['id'] , ':item_id' => $data['item_id']]);
            header('Location: /DiagonAlley');
            exit;
        }
    }

    public static function showMagicalItemsByUserId($userId) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT id, price, type, imag FROM magicalitem WHERE stud_id = :userId;");
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(); // Return the items directly
    }

    public static function sellItem() {
        $data = $_POST;
        $pdo = Database::getInstance();

        // Reset the stud_id of the sold item
        $stmt = $pdo->prepare("UPDATE magicalitem 
                               SET stud_id = NULL 
                               WHERE id = :item_id AND stud_id = :user_id;");
        $stmt->execute([':item_id' => $data['item_id'], ':user_id' => $_SESSION['user']['id']]);

        // Update session points
        $_SESSION['student']['points'] += $data['item_price'];

        // Update points in the database
        $stmt = $pdo->prepare("UPDATE students 
                               SET points = points + :price 
                               WHERE id = :user_id;");
        $stmt->execute([':price' => $data['item_price'], ':user_id' => $_SESSION['user']['id']]);

        header('Location: /profile');
        exit;
    }
}