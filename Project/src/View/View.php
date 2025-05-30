<?php

namespace src\View;

class View
{
    private $path;
    
    public function __construct()
    {
        $this->path = str_replace('\\', '/', dirname(dirname(__DIR__))) . '/templates/';
    }
    
    public function renderHtml($templateName, $vars = [], $code = 200)
    {
        http_response_code($code);
        extract($vars);
        
        $templateName = preg_replace('/\.php$/', '', $templateName);
        $templatePath = $this->path . $templateName . '.php';
        
        if (!file_exists($templatePath)) {
            throw new \RuntimeException("Template not found: " . $templatePath);
        }
        
        include $templatePath;
    }    
}