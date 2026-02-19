<?php
require_once __DIR__ . '/../Models/User.php';
class UserController {
    private $userModel;

    public function __construct() {
        session_start();
        $this->userModel = new User();
    }

    public function register(): void {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = 'Email and password are required';
            } elseif ($this->userModel->findByEmail($email)) {
                $error = 'Email already exists';
            } else {
                $userId = $this->userModel->create($email, $password);
                if ($userId) {
                    header('Location: index.php?action=login');
                    exit();
                }
                $error = 'Registration failed';
            }
        }

        require __DIR__ . '/../Views/register.php';
    }

    public function login(): void {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php?action=users');
                exit();
            }
            $error = 'Invalid email or password';
        }

        require __DIR__ . '/../Views/login.php';
    }

    public function users(): void {
        if (empty($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        }
        $users = $this->userModel->getAll();
        require __DIR__ . '/../Views/users.php';
    }

    public function logout(): void {
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
}
