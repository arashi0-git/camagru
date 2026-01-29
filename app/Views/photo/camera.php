<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Camera</title></head>
<body>
    <h1>Camera</h1>

    <p>user_id: <?php echo (int)($_SESSION['user_id'] ?? 0); ?></p>
    <form method="POST" action="/photos/store" enctype="multipart/form-data">
        <input type="file" name="photo" accept="image/png,image/jpeg" required>
        <button type="submit">Upload</button>
    </form>

    <a href="/gallery">Gallery</a>
    <a href="/">Home</a>
</body>
</html>
