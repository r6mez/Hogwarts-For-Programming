<?php

require_once __DIR__ . '/vendor/autoload.php';

$dsn = 'mysql:host=localhost;charset=utf8mb4';
$dbname = 'hogwarts';
$username = 'hogwarts';
$password = 'hogwarts';

try {
    // Connect to MySQL server without specifying the database
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    // Update DSN to include the database
    $dsn = "mysql:host=localhost;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Function to drop all tables
    function dropAllTables(\PDO $pdo)
    {
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($tables as $table) {
            $pdo->exec("DROP TABLE IF EXISTS `$table`;");
        }
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");
    }

    // Drop all tables before running migrations
    dropAllTables($pdo);

    // Get all migration files and sort them by name
    $migrationFiles = glob(__DIR__ . '/migrations/*.php');
    sort($migrationFiles);

    foreach ($migrationFiles as $file) {
        $migration = require $file;
        if (is_callable($migration)) {
            $migration($pdo);
            echo "Executed migration: " . basename($file) . PHP_EOL;
        } else {
            echo "Skipped invalid migration: " . basename($file) . PHP_EOL;
        }
    }

    echo "All migrations executed successfully!";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Access denied') !== false) {
        echo "Database error: Access denied. Please check your username and password." . PHP_EOL;
        echo "To fix this issue, ensure the MySQL user exists and has the necessary permissions:" . PHP_EOL;
        echo "1. Log in to MySQL as root: mysql -u root -p" . PHP_EOL;
        echo "2. Run the following commands:" . PHP_EOL;
        echo "   CREATE USER 'hogwarts'@'localhost' IDENTIFIED BY 'hogwarts';" . PHP_EOL;
        echo "   GRANT ALL PRIVILEGES ON *.* TO 'hogwarts'@'localhost';" . PHP_EOL;
        echo "   FLUSH PRIVILEGES;" . PHP_EOL;
    } else {
        echo "Database error: " . $e->getMessage() . PHP_EOL;
    }
    exit(1);
}
