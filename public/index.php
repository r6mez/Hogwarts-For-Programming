<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/../src/';
    $relativeClass = str_replace('App\\', '', $class); // Remove the base namespace
    $file = $baseDir . str_replace(['\\', 'Controllers'], ['/', 'controllers'], $relativeClass) . '.php'; // Adjust case
    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Autoloader: Class file not found for $class at $file");
    }
});

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;

$app = new Application();
$app->run();
?>

<link rel="icon" href="assets/Slytherin.png" type="image/x-icon" />
