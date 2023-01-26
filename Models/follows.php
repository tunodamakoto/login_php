<?php
///////////////////////////////////////
// フォローデータを処理
///////////////////////////////////////

// フォロー作成
function createFollow(array $data)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' .$mysqli->connect_error. "\n";
        exit;
    }

    $query = 'INSERT INTO follows (follow_user_id, followed_user_id) VALUE (?, ?)';

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param('ii', $data['follow_user_id'], $data['followed_user_id']);

    if($stmt->execute()) {
        $res = $mysqli->insert_id;
    } else {
        $res = false;
        echo 'エラーメッセージ：' .$mysqli->error. "\n";
    }

    $stmt->close();
    $mysqli->close();

    return $res;
}

// フォローを取り消し
function deleteFollow(array $data)
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。：' .$mysqli->connect_error. "\n";
        exit;
    }

    $data['updated_at'] = date('Y-m-d H:i:s');

    $query = 'UPDATE follows SET status = "deleted", updated_at = ? WHERE id = ? AND follow_user_id = ?';

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param('sii', $data['updated_at'], $data['follow_id'], $data['follow_user_id']);

    $res = $stmt->execute();

    if($res === false) {
        echo 'エラーメッセージ：' .$mysqli->error. "\n";
    }

    $stmt->close();
    $mysqli->close();

    return $res;
}