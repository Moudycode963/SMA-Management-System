<?php

// 1. Autoloading
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\HomeController;

// 2. Router initialisieren
$router = new Router();

// 3. Routen definieren (Das Routing-Table)
// Wenn jemand '/' aufruft -> HomeController->index()
$router->get('/', [HomeController::class, 'index']);

// Wenn jemand '/login' aufruft -> HomeController->login()
$router->get('/login', [HomeController::class, 'login']);

// 4. App starten
$router->resolve();