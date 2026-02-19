<?php
require_once __DIR__ . '/../../config/database.php';
class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function create($email, $password) {
        $sql = "INSERT INTO users (email, password_hash, created_at) VALUES (:email, :password_hash, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':password_hash' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        return $this->pdo->lastInsertId();
    }

    public function login($email, $password) {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;
    }

    public function getAll() {
        $sql = "SELECT id, email, created_at FROM users";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
}
