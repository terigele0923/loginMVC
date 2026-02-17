<?php
declare(strict_types=1);//型宣言を厳格にするための宣言

use App\Controllers\AuthController;

session_start();

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $path = __DIR__ . '/../app/' . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($path)) {
        require $path;
    }
});

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}

// アプリケーションの実行パスに合わせて変更
$basePath = '/loginMVC/public';
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$requestPath = is_string($requestPath) ? $requestPath : '/';
if (str_starts_with($requestPath, $basePath)) {
    $requestPath = substr($requestPath, strlen($basePath));
}
$requestPath = rtrim($requestPath, '/');
$requestPath = $requestPath === '' ? '/' : $requestPath;

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$controller = new AuthController();

$routes = [
    'GET' => [
        '/' => [$controller, 'showLogin'],
        '/login' => [$controller, 'showLogin'],
    ],
    'POST' => [
        '/login' => [$controller, 'login'],
    ],
];

if (isset($routes[$method][$requestPath])) {
    call_user_func($routes[$method][$requestPath]);
    exit;
}

http_response_code(404);
echo '404 Not Found';
