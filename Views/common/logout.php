<?php if($view_user['id'] !== $view_requested_user['id']): ?>
    <div class="logout">
        <a href="home.php">プロフィール</a>
        <a href="sign-out.php">ログアウト</a>
    </div>
<?php else: ?>
    <div class="logout">
        <a href="sign-out.php">ログアウト</a>
    </div>
<?php endif; ?>