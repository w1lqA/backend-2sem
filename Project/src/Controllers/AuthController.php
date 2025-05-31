<?php

namespace src\Controllers;

use src\View\View;
use src\Models\Users\User;
use src\Exceptions\InvalidArgumentException;

class AuthController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login([
                    'nickname' => $_POST['nickname'] ?? '',
                    'password' => $_POST['password'] ?? '',
                ]);
                
                setcookie('authToken', $user->getAuthToken(), time() + 3600 * 24 * 30, '/');
                session_start();
                $_SESSION['user_id'] = $user->getId(); 
                header('Location: ' . dirname($_SERVER['SCRIPT_NAME']));
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('auth/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('auth/login.php');
    }

    public function logout()
    {
        setcookie('authToken', '', time() - 3600, '/');
        header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/login');
        exit();
    }
}