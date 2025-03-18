<?php

return function (\PDO $pdo) {
    $query = "
        CREATE TABLE IF NOT EXISTS professors (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            experience VARCHAR(255) NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
    ";
    $pdo->exec($query);
};
