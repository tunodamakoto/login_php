
<div class="acount">
    <div class="profile">
        <img class="profile-img" src="<?php echo buildImagePath($view_requested_user['image_name']); ?>" alt="">
        <?php if($view_user['id'] !== $view_requested_user['id']): ?>
            <button class="follow">フォローを外す</button>
        <?php else: ?>
            <button class="profile-btn" id="modalOpen">プロフィール編集</button>
            <div class="modal" id="modal">
                <div class="modal-content">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">プロフィールを編集</h5>
                        </div>
                        <div class="modal-body">
                            <div class="img">
                                <img src="<?php echo buildImagePath($view_user['image_name']); ?>" alt="">
                            </div>
                            <div class="file">
                                <label for="">プロフィール写真</label>
                                <input type="file" name="image">
                            </div>
                            <input class="form-control input" type="text" name="nickname" value="<?php echo htmlspecialchars($view_user['nickname']); ?>" placeholder="ニックネーム" maxlength="50" required>
                            <input class="form-control input" type="text" name="name" value="<?php echo htmlspecialchars($view_user['name']); ?>" placeholder="ユーザー名" maxlength="50" required>
                            <input class="form-control input" type="email" name="email" value="<?php echo htmlspecialchars($view_user['email']); ?>" placeholder="メールアドレス" maxlength="254" required>
                            <input class="form-control input" type="password" name="password" placeholder="パスワードを変更する場合ご入力ください" minlength="4" maxlength="128">
                            <textarea name="profile" class="form-control" value="<?php echo htmlspecialchars($view_user['profile']); ?>" placeholder="プロフィール"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="modal-cansel" id="modalCansel">キャンセル</button>
                            <button class="modal-save" type="submit">保存する</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="nickname"><?php echo htmlspecialchars($view_requested_user['nickname']); ?></div>
    <div class="name"><?php echo htmlspecialchars($view_requested_user['name']); ?></div>
    <div class="follow">
        <div class="follow-count">1</div>
        <div class="follow-text">フォロー中</div>
        <div class="follow-count">1</div>
        <div class="follow-text">フォロワー</div>
    </div>
    <div class="text"><?php echo htmlspecialchars($view_requested_user['profile']); ?></div>
</div>