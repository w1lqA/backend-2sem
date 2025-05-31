<?php

spl_autoload_register(function(string $className) {
    require(dirname(__DIR__).'\\'.$className.'.php');
});

$route = $_GET['route'] ?? '';
$patterns = require('route.php');
$findRoute = false;

foreach($patterns as $pattern => $controllerAndAction) {
    if (preg_match($pattern, $route, $matches)) {
        unset($matches[0]);

        if (is_array($controllerAndAction[0])) {
            foreach ($controllerAndAction as $handler) {
                [$class, $method] = $handler;
                $instance = new $class;
                $instance->$method(...$matches);
            }
        } else {
            $controller = new $controllerAndAction[0];
            $action = $controllerAndAction[1];
            $controller->$action(...$matches);
        }

        $findRoute = true;
        break;
    }
}

if (!$findRoute) {
    (new src\Controllers\MainController())->notFound();
}