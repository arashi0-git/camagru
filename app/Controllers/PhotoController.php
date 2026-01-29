<?php

class PhotoController
{
    public function camera(): void
    {
        require_once __DIR__ . '/../Core/Auth.php';
        Auth::requireLogin();

        require __DIR__ . '/../Views/photo/camera.php';
    }

    public function store(): void
    {
        require_once __DIR__ . '/../Core/Auth.php';
        require_once __DIR__ . '/../Core/Database.php';
        require_once __DIR__ . '/../Models/Photo.php';

        Auth::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /camera');
            exit;
        }

        if (empty($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            header('Location: /camera');
            exit;
        }

        $tmp = $_FILES['photo']['tmp_name'];

        $info = @getimagesize($tmp);
        if ($info === false) {
            header('Location: /camera');
            exit;
        }

        $mime = $info['mime'] ?? '';
        $ext = '';

        if ($mime === 'image/jpeg') $ext = 'jpg';
        if ($mime === 'image/png') $ext = 'png';
        if ($ext === '') {
            header('Location: /camera');
            exit;
        }

        $filename = bin2hex(random_bytes(16)) . '.' .$ext;

        $dest = __DIR__ . '/../../storage/uploads/' . $filename;

        if (!move_uploaded_file($tmp, $dest)) {
            header('Location: /camera');
            exit;
        }

        $pdo = Database::pdo();
        Photo::create($pdo, Auth::id(), $filename);

        header('Location: /gallery');
        exit;
    }

    public function gallery(): void
    {
        require_once __DIR__ . '/../Core/Database.php';
        require_once __DIR__ . '/../Models/Photo.php';

        $pdo = Database::pdo();
        $photos = Photo::latest($pdo, 50);

        require __DIR__ . '/../Views/photo/gallery.php';
    }
}
