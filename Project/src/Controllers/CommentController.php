<?php

namespace src\Controllers;

use src\View\View;
use src\Models\Comments\Comment;
use src\Models\Articles\Article;
use src\Models\Users\User;

class CommentController
{
    private $basePath;

    public function __construct()
    {
        $this->basePath = dirname($_SERVER['SCRIPT_NAME']);
    }

    public function store(int $articleId)
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: ' . $this->basePath . '/auth/login');
            exit;
        }

        $user = User::getById($userId);
        $article = Article::getById($articleId);

        if (!$user || !$article || empty($_POST['text'])) {
            header('Location: ' . $this->basePath . "/article/{$articleId}");
            exit;
        }

        $comment = new Comment();
        $comment->setAuthor($user);
        $comment->setArticle($article);
        $comment->setText($_POST['text']);
        $comment->save();

        header('Location: ' . $this->basePath . "/article/{$articleId}#comment" . $comment->getId());
        exit;
    }

    public function edit(int $commentId)
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        $comment = Comment::getById($commentId);
        if (!$comment || $comment->getAuthor()->getId() !== $userId) {
            header('HTTP/1.0 403 Forbidden');
            echo "Доступ запрещён";
            exit;
        }
    
        $view = new View();
        $view->renderHtml('comment/edit', ['comment' => $comment]);
    }
    
    public function update(int $commentId)
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;
        $comment = Comment::getById($commentId);
        if (!$comment || $comment->getAuthor()->getId() !== $userId) {
            header('HTTP/1.0 403 Forbidden');
            echo "Доступ запрещён";
            exit;
        }
    
        if (!empty($_POST['text'])) {
            $comment->setText($_POST['text']);
            $comment->save();
        }
    
        header('Location: ' . $this->basePath . "/article/{$comment->getArticleId()}#comment" . $comment->getId());

        exit;
    }
    
}
