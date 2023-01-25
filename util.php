<?php
///////////////////////////////////////
// 便利な関数
///////////////////////////////////////

// 画像ファイル名から画像のURLを生成する
function buildImagePath(string $name = null)
{
    if(!isset($name)) {
        return HOME_URL .'Views/img/user.svg';
    }

    return HOME_URL. 'Views/img/' .htmlspecialchars($name);
}

// ユーザー情報をセッションに保存
function saveUserSession(array $user)
{
    // セッションを開始していない場合
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // セッションに保存
    $_SESSION['USER'] = $user;
}

// セッションのユーザー情報を取得
function getUserSession()
{
    // セッションを開始していない場合
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // セッションにユーザー情報がない場合
    if(!isset($_SESSION['USER'])) {
        return false;
    }

    $user = $_SESSION['USER'];

    // 画像ファイル名からファイルのURLを取得
    if(!isset($user['image_name'])) {
        $user['image_name'] = null;
    }
    $user['image_path'] = buildImagePath($user['image_name']);

    return $user;
}