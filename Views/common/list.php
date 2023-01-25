<div class="list">
    <h2>アカウント一覧</h2>
    <?php foreach($view_acount as $value): ?>
    <a href="" class="user">
        <img src="<?php echo buildImagePath($value['image_name']); ?>" alt="">
        <div class="nickname"><?php echo htmlspecialchars($value['nickname']); ?></div>
    </a>
    <?php endforeach; ?>
</div>