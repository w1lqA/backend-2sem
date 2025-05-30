<?php

namespace src\Controllers;
use src\View\View;

class MainController{
    private $view;
    public function __construct()
    {
        $this->view = new View;   
    }

    public function sayHello(string $name){
        $this->view->renderHtml('main/hello', ['name'=>$name]);
    }

    public function notFound()
    {
        $this->view->renderHtml('error/404.php', [], 404);
    }
}