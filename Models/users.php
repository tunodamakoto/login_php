<?php
///////////////////////////////////////
// ユーザーデータを処理
///////////////////////////////////////

// ユーザー作成
function createUser(array $data)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' .$mysqli->connect_error. "\n";
        exit;
    }

    $query = 'INSERT INTO users (nickname, name, email, password) VALUES (?, ?, ?, ?)';

    $stmt = $mysqli->prepare($query);

    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $stmt->bind_param('ssss', $data['nickname'], $data['name'], $data['email'], $data['password']);

    $res = $stmt->execute();

    if($res === false) {
        echo 'エラーメッセージ：' .$mysqli->connect_error. "\n";
    }

    $stmt->close();
    $mysqli->close();

    return $res;
}


// ユーザーを更新
function updateUser(array $data)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' .$mysqli->connect_error. "\n";
        exit;
    }

    $data['updated_at'] = date('Y-m-d H:i:s');

    // パスワードのハッシュ化
    if(isset($data['password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    // SQL句のカラム準備
    $set_columns = [];
    foreach(['nickname', 'name', 'email', 'password', 'image_name', 'profile', 'updated_at'] as $column) {
        if(isset($data[$column]) && $data[$column] !== '') {
            $set_columns[] = $column . ' = "' . $mysqli->real_escape_string($data[$column]) . '"';
        }
    }

    // クエリ組み立て
    $query = 'UPDATE users SET ' . join(',', $set_columns);
    $query .= 'WHERE id = "' .$mysqli->real_escape_string($data['id']) . '"';

    // クエリの実行
    $res = $mysqli->query($query);

    if($res === false) {
        echo 'エラーメッセージ： ' .$mysqli->error . "\n";
    }

    $mysqli->close();

    return $res;
}


// ユーザーのアカウント一覧（自分以外のユーザー表示）
function acountUser(int $user_id)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' .$mysqli->connect_error. "\n";
        exit;
    } 

    $query = 'SELECT id, nickname, email, image_name, profile FROM users WHERE NOT  id = "' .$user_id. '" ORDER BY created_at DESC';

    $result = $mysqli->query($query);

    if(!$result) {
        echo 'エラーメッセージ：' .$mysqli->error. "\n";
        $mysqli->close();
        return false;
    }

    $user = $result->fetch_all(MYSQLI_ASSOC);

    if(!$user) {
        $mysqli->close();
        return false;
    }

    $mysqli->close();

    return $user;
}


// ログイン情報をサーバーから取得（パスワードチェック）
function findUserAndCheckPassword(string $email, string $password)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' .$mysqli->connect_error. "\n";
        exit;
    }

    $email = $mysqli->real_escape_string($email);

    $query = 'SELECT * FROM users WHERE email = "' .$email. '"';

    $result = $mysqli->query($query);

    if(!$result) {
        echo 'エラーメッセージ：' .$mysqli->error. "\n";
        $mysqli->close();
        return false;
    }

    $user = $result->fetch_array(MYSQLI_ASSOC);

    if(!$user) {
        $mysqli->close();
        return false;
    }

    // パスワードチェック
    if(!password_verify($password, $user['password'])) {
        $mysqli->close();
        return false;
    }

    $mysqli->close();

    return $user;
}


// ユーザーを1件取得
function findUser(int $user_id, int $login_user_id = null)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' .$mysqli->connect_error. "\n";
        exit;
    }

    $user_id = $mysqli->real_escape_string($user_id);
    $login_user_id = $mysqli->real_escape_string($login_user_id);

    $query = <<<SQL
        SELECT
            U.id,
            U.name,
            U.nickname,
            U.email,
            U.image_name,
            U.profile,
            -- フォロー中の数
            (SELECT COUNT(1) FROM follows WHERE status = 'active' AND follow_user_id = U.id) AS follow_user_count,
            -- フォロワーの数
            (SELECT COUNT(1) FROM follows WHERE status = 'active' AND followed_user_id = U.id) AS followed_user_count,
            -- ログインユーザーがフォローしている場合、フォローIDが入る
            F.id AS follow_id
        FROM
            users AS U
            LEFT JOIN follows AS F ON F.status = 'active' AND F.followed_user_id = '$user_id' AND F.follow_user_id = '$login_user_id'
        WHERE
            U.status = 'active' AND U.id = '$user_id'
    SQL;

    if($result = $mysqli->query($query)) {
        $res = $result->fetch_array(MYSQLI_ASSOC);
    } else {
        $res = false;
        echo 'エラーメッセージ；' .$mysqli->error. "\n";
    }

    $mysqli->close();

    return $res;
}