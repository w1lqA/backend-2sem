<?php

return [
    '~^login$~' => [src\Controllers\AuthController::class, 'login'],
    '~^logout$~' => [src\Controllers\AuthController::class, 'logout'],
    
    '~^hello/(.+)$~' => [src\Controllers\MainController::class, 'sayHello'],
    
    '~^$~' => [
        [src\Middleware\AuthMiddleware::class, 'handle'],
        [src\Controllers\ArticleController::class, 'index']
    ],
    '~^article/(\d+)$~' => [
        [src\Middleware\AuthMiddleware::class, 'handle'],
        [src\Controllers\ArticleController::class, 'show']
    ],
    '~^article/create$~' => [
        [src\Middleware\AuthMiddleware::class, 'handle'],
        [src\Controllers\ArticleController::class, 'create']
    ],
    '~^article/(\d+)/edit$~' => [
        [src\Middleware\AuthMiddleware::class, 'handle'],
        [src\Controllers\ArticleController::class, 'edit']
    ],
    '~^article/(\d+)/update$~' => [
        [src\Middleware\AuthMiddleware::class, 'handle'],
        [src\Controllers\ArticleController::class, 'update']
    ],
    '~^article/(\d+)/delete$~' => [
        [src\Middleware\AuthMiddleware::class, 'handle'],
        [src\Controllers\ArticleController::class, 'delete']
    ],
    '~^article/store$~' => [
        [src\Middleware\AuthMiddleware::class, 'handle'],
        [src\Controllers\ArticleController::class, 'store']
    ],
    
    '~.*~' => [src\Controllers\MainController::class, 'notFound']
];