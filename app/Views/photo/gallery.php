<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Gallery</title></head>
<body>
    <h1>Gallery</h1>

    <p> <a href="/camera">Back to Camera</a></p>

    <?php if (empty($photos)) : ?>
        <p>No photos yet.</p>
    <?php endif; ?>

    <?php foreach ($photos as $p) : ?>
        <div style="margin-bottom:16px;">
            <div>
                by <?php echo htmlspecialchars($p['username'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <img
                src="/uploads/<?php echo htmlspecialchars($p['filename'], ENT_QUOTES, 'UTF-8'); ?>"
                style="max-width: 400px;"
                alt=""
            >
        </div>
    <?php endforeach; ?>
</body>
</html>
