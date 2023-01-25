<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../Views/common/head.php'); ?>
    <title>Login | ログイン画面</title>
</head>
<body class="sign">
    <main class="form-sign">
        <form action="" method="post">
            <h1>ログインする</h1>
            <?php if(isset($view_try_login_result) && $view_try_login_result === false): ?>
                <div class="sign-alert">ログインに失敗しました</div>
            <?php endif; ?>
            <input class="form-control" type="email" name="email" placeholder="メールアドレス" maxlength="254" required autofocus>
            <input class="form-control" type="password" name="password" placeholder="パスワード" minlength="4" maxlength="128" required>
            <button class="sign-btn" type="submit">ログイン</button>
            <p class="sign-link"><a href="sign-up.php">会員登録する</a></p>
            <p class="sign-copy">&copy; 2023</p>
        </form>
    </main>
</body>
</html>