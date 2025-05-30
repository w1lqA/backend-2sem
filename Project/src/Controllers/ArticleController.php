<?php

namespace src\Controllers;
use src\View\View;
use src\Models\Articles\Article;

class ArticleController
{
    private $view;
    private $db;
    private $basePath;

    public function __construct()
    {
        $this->view = new View();
        $this->basePath = dirname($_SERVER['SCRIPT_NAME']);
    }
    

    public function index(){
        $articles = Article::findAll();
        $this->view->renderHtml('article/index', ['articles'=>$articles]);
    }

    public function show($id){
        $article = Article::getById($id);
            if ($article == []) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('article/show', ['article'=>$article]);
    }

    public function edit($id){
        $article = Article::getById($id);
        $this->view->renderHtml('article/edit', ['article'=>$article]);
    }

    public function update(int $articleId): void
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            $this->view->renderHtml('error/404.php', [], 404);
            return;
        }

        if (!isset($_POST['title'], $_POST['text'], $_POST['date'])) {
            $this->view->renderHtml('error/404.php', [], 400);
            return;
        }

        $article->setTitle($_POST['title']);
        $article->setText($_POST['text']);

        $articleReflection = new \ReflectionClass($article);
        $property = $articleReflection->getProperty('createdAt');
        $property->setAccessible(true);
        $property->setValue($article, $_POST['date']);

        $article->save();

        header('Location: ' . $this->basePath . '/article/' . $article->getId());
        exit;
        
    }

    public function create(){
        $this->view->renderHtml('article/create');
    }
    

    public function store(){
        $article = new Article;
        $article->setTitle($_POST['title']);
        $article->setText($_POST['text']);
        
        $user = \src\Models\Users\User::getById(1);
        if (!$user) {
            throw new \Exception('Пользователь не найден');
        }
        
        $article->setAuthor($user);
        $article->save();
        
        header('Location: ' . $this->basePath . '/');
        exit;
    }

    public function delete(int $id){
        $article = Article::getById($id);
        $article->delete();

        header('Location: ' . $this->basePath . '/');
        exit;
        
    }
}