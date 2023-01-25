<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../Views/common/head.php'); ?>
    <title>Login | 会員登録画面</title>
</head>
<body class="sign">
    <main class="form-sign">
        <form action="" method="post">
            <h1>アカウントを作る</h1>
            <input class="form-control" type="text" name="nickname" placeholder="ニックネーム" maxlength="50" required autofocus>
            <input class="form-control" type="text" name="name" placeholder="ユーザー名 例)tanaka1234" required>
            <input class="form-control" type="email" name="email" placeholder="メールアドレス" maxlength="254" required>
            <input class="form-control" type="password" name="password" placeholder="パスワード" minlength="4" maxlength="128" required>
            <button class="sign-btn" type="submit">登録する</button>
            <p class="sign-link"><a href="">ログインする</a></p>
            <p class="sign-copy">&copy; 2023</p>
        </form>
    </main>
</body>
</html>