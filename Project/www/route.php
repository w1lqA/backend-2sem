<?php

return [
    '~^$~' => [src\Controllers\ArticleController::class, 'index'],
    '~^article/(\d+)$~' => [src\Controllers\ArticleController::class, 'show'],
    '~^hello/(.+)$~' => [src\Controllers\MainController::class, 'sayHello'],
    '~^article/create$~' => [src\Controllers\ArticleController::class, 'create'],
    '~^article/(\d+)/edit~' => [src\Controllers\ArticleController::class, 'edit'],
    '~^article/(\d+)/update~' => [src\Controllers\ArticleController::class, 'update'],
    '~^article/(\d+)/delete$~' => [src\Controllers\ArticleController::class, 'delete'],
    '~^article/store$~' => [src\Controllers\ArticleController::class, 'store'],
    '~.*~' => [src\Controllers\MainController::class, 'notFound']
];
