<div class="list">
    <h2>アカウント一覧</h2>
    <?php foreach($view_acount as $value): ?>
    <a href="home.php?user_id=<?php echo htmlspecialchars($value['id']); ?>" class="user">
        <img src="<?php echo buildImagePath($value['image_name']); ?>" alt="">
        <div class="nickname"><?php echo htmlspecialchars($value['nickname']); ?></div>
    </a>
    <?php endforeach; ?>
</div>