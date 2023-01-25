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
    $_SESSION['PROFILE'] = $user;
}


// ユーザー情報をセッションから削除
function deleteUserSession()
{
    // セッションを開始していない場合
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    unset($_SESSION['PROFILE']);
}


// セッションのユーザー情報を取得
function getUserSession()
{
    // セッションを開始していない場合
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // セッションにユーザー情報がない場合
    if(!isset($_SESSION['PROFILE'])) {
        return false;
    }

    $user = $_SESSION['PROFILE'];

    // 画像ファイル名からファイルのURLを取得
    if(!isset($user['image_name'])) {
        $user['image_name'] = null;
    }
    $user['image_path'] = buildImagePath($user['image_name']);

    return $user;
}


// 画像のアップロード
function uploadImage(array $user, array $file)
{
    // 画像ファイル名から拡張子を取得
    $image_extension = strchr($file['name'], '.');

    // 画像のファイル名を作成
    $image_name = $user['id'] . '_' . date('YmdHis') . $image_extension;

    // 保存先のディレクトリ
    $directory = '../Views/img/';

    // 画像のパス
    $image_path = $directory . $image_name;

    // 画像を設置
    move_uploaded_file($file['tmp_name'], $image_path);

    // 画像ファイルチェック
    if(exif_imagetype($image_path)) {
        return $image_name;
    }
    echo '選択されたファイルが画像ではないため処理を停止しました。';
    exit;
}