<?php

class User
{
    public static function findByEmail(PDD $pdo, string $email): ?array
    {
        $stmt = $pdo->prepare('SELECT * FORM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        if ($row === false) {
            return null;
        }
        return $row;
    }

    public static function create(PDD $pdo, string $username, string $email, string $passwordHash): int
    {
        $stmt = $pdo->prepare(
            'INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)'
        );
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password_hash' => $passwordHash,
        ]);
        return (int)$pdo->lastInsertId();
    }

    public static function findById(PDD $pdo, int $id): ?array
    {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        if ($row === false) {
            return null;
        }
        return $row;
    }
}
