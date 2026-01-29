<?php

class Photo
{
    public static function create(PDO $pdo, int $userId, string $filename): int
    {
        $stmt = $pdo->prepare(
            'INSERT INTO photos (user_id, filename) VALUES (:user_id, :filename)'
        );
        $stmt->execute([
            'user_id' => $userId,
            'filename' => $filename,
        ]);

        return (int)$pdo->lastInsertId();
    }

    public static function latest(PDO $pdo, int $limit = 20): array
    {
        $stmt = $pdo->prepare(
            'SELECT photos.*, users.username
            FROM photos
            JOIN users ON users.id = photos.user_id
            ORDER BY photos.id DESC
            LIMIT :lim'
        );
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
