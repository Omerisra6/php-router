<?php

use App\Controllers\UserController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\LogMiddleware;
use App\Middlewares\MaintenanceModeMiddleware;
use App\Utils\Router;

Router::get('/user/profile', [UserController::class, 'profile'])->assignMiddlewares([
    LogMiddleware::class,
    MaintenanceModeMiddleware::class
]);

Router::post('/user/profile', [UserController::class, 'store'])->assignMiddlewares([
    LogMiddleware::class,
    MaintenanceModeMiddleware::class
]);

Router::view('/dashboard', 'dashboard')->assignMiddleware(AuthMiddleware::class);
$_SESSION['id'] = 1;
Router::route($_SERVER['REQUEST_URI']);