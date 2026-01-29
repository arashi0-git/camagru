<?php
# Functionality for routing URL requests from users
class Router{
    public function dispatch(): void {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($path === '/' || $path === '') {
            require_once __DIR__ . '/../Controllers/HomeController.php';
            (new HomeController())->index();
            return;
        }

        if ($path === '/login') {
            require_once __DIR__ . '/../Controllers/AuthController.php';
            (new AuthController())->login();
            return;
        }

        if ($path === '/logout') {
            require_once __DIR__ . '/../Controllers/AuthController.php';
            (new AuthController())->logout();
            return;
        }

        if ($path === '/register') {
            require_once __DIR__ . '/../Controllers/AuthController.php';
            (new AuthController())->register();
            return;
        }

        if ($path === '/camera') {
            require_once __DIR__ . '/../Controllers/PhotoController.php';
            (new PhotoController())->camera();
            return;
        }

        if ($path === '/photos/store') {
            require_once __DIR__ . '/../Controllers/PhotoController.php';
            (new PhotoController())->store();
            return;
        }

        if ($path === '/gallery') {
            require_once __DIR__ . '/../Controllers/PhotoController.php';
            (new PhotoController())->gallery();
            return;
        }

        // check DB don't need but it can use test of connection
        // if ($path === '/db-check') {
        //     require_once __DIR__ . '/../Core/Database.php';
        //     $pdo = Database::pdo();
        //     echo 'DB OK';
        //     return;
        // }

        http_response_code(404);
        require_once __DIR__ . '/../Views/error/404.php';
    }
}
