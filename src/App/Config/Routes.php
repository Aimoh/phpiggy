<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\AuthController;
use App\Controllers\TransactionController;
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};
use Framework\App;
use App\Controllers\AboutController;
use App\Controllers\HomeController;

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction', [TransactionController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction', [TransactionController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}', [TransactionController::class, 'editView']);
    $app->post('/transaction/{transaction}', [TransactionController::class, 'edit']);
    $app->delete('/transaction/{transaction}', [TransactionController::class, 'delete']);
}