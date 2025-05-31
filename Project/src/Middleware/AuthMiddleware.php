<?php

namespace src\Middleware;

use src\Models\Users\User;

class AuthMiddleware
{
    public function handle(): void
    {
        if (empty($_COOKIE['authToken'])) {
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/login');
            exit();
        }

        $user = User::findOneByColumn('auth_token', $_COOKIE['authToken']);
        if ($user === null) {
            setcookie('authToken', '', time() - 3600, '/');
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/login');
            exit();
        }
    }
}