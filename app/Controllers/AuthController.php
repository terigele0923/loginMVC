<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Auth;

final class AuthController
{
    public function showLogin(array $errors = [], string $email = ''): void
    {
        $csrf = $_SESSION['csrf_token'] ?? '';
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {
        $postedToken = (string)($_POST['csrf_token'] ?? '');
        $sessionToken = (string)($_SESSION['csrf_token'] ?? '');
        if ($postedToken === '' || $sessionToken === '' || !hash_equals($sessionToken, $postedToken)) {
            $this->showLogin(
                ['不正なリクエストです。再度お試しください。'],
                (string)($_POST['email'] ?? '')
            );
            return;
        }

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
            // ログイン成功時のみセッションIDを再生成
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['user_email'] = (string)$user['email'];

            header('Content-Type: text/plain; charset=UTF-8');
            echo "ログイン成功: {$user['email']}\n";
            return;
        }

        $this->showLogin(['メールアドレスまたはパスワードが正しくありません。'], $email);
    }
}
