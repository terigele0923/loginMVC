<?php 
require_once __DIR__ . '/../app/Controllers/UserController.php';

$action = $_GET['action'] ?? 'login';
$controller = new UserController();

switch($action) {
    case 'login':
        $controller->login();
        break;
    case 'register':
        $controller->register();
        break;
    case 'users':
        $controller->users();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        $controller->login();
}
