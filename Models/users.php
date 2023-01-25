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

    $data['password'] = password_hash($data['passowrd'], PASSWORD_DEFAULT);

    $stmt->bind_param('ssss', $data['nickname'], $data['name'], $data['email'], $data['password']);

    $res = $stmt->execute();

    if($res === false) {
        echo 'エラーメッセージ：' .$mysqli->connect_error. "\n";
    }

    $stmt->close();
    $mysqli->close();

    return $res;
}