<?php

class AuthController
{
    public function register(): void
    {
        require_once __DIR__ . '/../Core/Database.php';
        require_once __DIR__ . '/../Models/User.php';

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $email === '' || $password === '') {
                $error = '全て入力してください';
            } else {
                $pdo = Database::pdo();

                if (User::findByEmail($pdo, $email) !== null) {
                    $error = 'そのメールは既に使われています';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $userId = User::create($pdo, $username, $email, $hash);

                    $_SESSION['user_id'] = $userId;
                    header('Location: /');
                    exit;
                }
            }
        }

        require __DIR__ . '/../Views/auth/register.php';
    }

    public function login(): void
    {
        require_once __DIR__ . '/../Core/Database.php';
        require_once __DIR__ . '/../Models/User.php';

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = 'メールとパスワードを入力してください';
            } else {
                $pdo = Database::pdo();
                $user = User::findByEmail($pdo, $email);

                if ($user === null || !password_verify($password, $user['password_hash'])) {
                    $error = 'メールまたはパスワードが違います';
                } else {
                    $_SESSION['user_id'] = (int)$user['id'];
                    header('Location: /');
                    exit;
                }
            }
        }

        require __DIR__ . '/../Views/auth/login.php';
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        header('Location: /login');
        exit;
    }
}
