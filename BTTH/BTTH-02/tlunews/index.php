<?php


session_start();
spl_autoload_register(function ($class) {
    if (file_exists("controllers/$class.php")) {
        require_once "controllers/$class.php";
    } elseif (file_exists("models/$class.php")) {
        require_once "models/$class.php";
    }
});

$controllerName = $_GET['controller'] ?? 'home';
$actionName = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controllerName) . 'Controller';
if (!class_exists($controllerClass)) {
    die("Controller $controllerClass not found.");
}

$controller = new $controllerClass();

if (!method_exists($controller, $actionName)) {
    die("Action $actionName not found in $controllerClass.");
}

if ($actionName == "detail" || $actionName == "delete" || $actionName == "edit") {
    $controller->$actionName($_GET['id']);
} else {
    $controller->$actionName();
}
