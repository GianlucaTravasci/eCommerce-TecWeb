<?php

require '../vendor/autoload.php';

// Define base path to reference files
define("BASE_PATH", realpath(__DIR__ . '/../'));

// Parse and load .env configuration
$dotenv = new \Dotenv\Dotenv(base_path(), '.env');
$dotenv->load();
$dotenv->required(['DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'])->notEmpty();

// Build globals
$session = new \Framework\Request\PhpSession();
$request = \Framework\Request\Request::current();

// Route user to content
$router = new \Framework\Router\Router();

$router->loadRoutes(app_path('routes.php'));

try {
    $router->go($request);
} catch (\Framework\Router\Exceptions\RouterException $e) {
    $router->run(
        [\App\Controllers\ErrorController::class, 'notFound'],
        $request
    );
}
