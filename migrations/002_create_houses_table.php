<?php

return function (\PDO $pdo) {
    $query = "
        CREATE TABLE IF NOT EXISTS houses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL UNIQUE
        );

        INSERT INTO houses (name) VALUES
        ('Gryffindor'),
        ('Hufflepuff'),
        ('Ravenclaw'),
        ('Slytherin');
    ";
    $pdo->exec($query);
};
