
<div class="acount">
    <div class="profile">
        <img class="profile-img" src="img/user.svg" alt="">
        <button class="profile-btn" id="modalOpen">プロフィール編集</button>
        <div class="modal" id="modal">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title">プロフィールを編集</h5>
                    </div>
                    <div class="modal-body">
                        <div class="img">
                            <img src="img/user.svg" alt="">
                        </div>
                        <div class="file">
                            <label for="">プロフィール写真</label>
                            <input type="file">
                        </div>
                        <input class="form-control input" type="text" name="nickname" placeholder="ニックネーム" maxlength="50" required>
                        <input class="form-control input" type="text" name="name" placeholder="ユーザー名" maxlength="50" required>
                        <input class="form-control input" type="email" name="email" placeholder="メールアドレス" maxlength="254" required>
                        <input class="form-control input" type="password" name="password" placeholder="パスワードを変更する場合ご入力ください" minlength="4" maxlength="128">
                        <textarea name="profile" class="form-control" placeholder="プロフィール"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-cansel">キャンセル</button>
                        <button class="modal-save">保存する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="nickname">ニックネーム</div>
    <div class="name">@name123</div>
    <div class="follow">
        <div class="follow-count">1</div>
        <div class="follow-text">フォロー中</div>
        <div class="follow-count">1</div>
        <div class="follow-text">フォロワー</div>
    </div>
    <div class="text">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</div>
</div>