<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

final class Auth
{
    /**
     * ログインに成功したらユーザー情報を返す。失敗したらnull。
     */
    public function attempt(string $email, string $password): ?array
    {
        $pdo = Database::pdo();

        $stmt = $pdo->prepare('SELECT id, email, password_hash FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();
        if ($user === false) {
            return null;
        }

        if (!password_verify($password, (string)$user['password_hash'])) {
            return null;
        }

        return [
            'id' => (int)$user['id'],
            'email' => (string)$user['email'],
        ];
    }
}
