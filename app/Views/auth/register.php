<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Register</title></head>
<body>
    <h1>Register</h1>

    <?php if ($error !== '') : ?>
        <p style="color:red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <form method="POST" action="/register">
        <input type="text" name="username" placeholder="username" required>
        <input type="email" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="password" required>
        <button type="submit">Create account</button>
    </form>

    <a href="/login">Login</a>
</body>
</html>
