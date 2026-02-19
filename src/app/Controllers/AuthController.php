<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Auth;

final class AuthController
{
    public function showLogin(array $errors = [], string $email = '', string $success = ''): void
    {
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');

        $errors = [];
        if ($email === '') {
            $errors[] = 'メールアドレスを入力してください。';
        }
        if ($password === '') {
            $errors[] = 'パスワードを入力してください。';
        }

        if ($errors !== []) {
            $this->showLogin($errors, $email);
            return;
        }

        $auth = new Auth();

        $user = $auth->attempt($email, $password);
        if ($user !== null) {
            $this->showLogin([], $email, "ログイン成功: {$user['email']}");
            return;
        }

        $this->showLogin(['メールアドレスまたはパスワードが正しくありません。'], $email);
    }
}
