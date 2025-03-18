<?php

return function (\PDO $pdo) {
    $query = "
        CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            points INT DEFAULT 0,
            house_id INT NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (house_id) REFERENCES houses(id)
        );
    ";
    $pdo->exec($query);
};
