<?php

spl_autoload_register(function(string $className) {
    require(dirname(__DIR__).'\\'.$className.'.php');
});

$route = $_GET['route'] ?? '';
$patterns = require('route.php');
$findRoute = false;

foreach($patterns as $pattern => $controllerAndAction) {
    if(preg_match($pattern, $route, $matches)) {
        unset($matches[0]);
        $controller = new $controllerAndAction[0];
        $action = $controllerAndAction[1];
        $controller->$action(...$matches);
        $findRoute = true;
        break;
    }
}

if (!$findRoute) {
    (new src\Controllers\MainController())->notFound();
}