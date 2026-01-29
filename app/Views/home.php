<?php
$loggedIn = !empty($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Home</title></head>
<body>
    <h1>Camagru Home</h1>

    <?php if ($loggedIn) : ?>
        <p>Logged in (user_id: <?php echo (int)$_SESSION['user_id']; ?>)</p>
        <a href="/logout">Logout</a>
    <?php else : ?>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
    <?php endif; ?>
</body>
</html>
