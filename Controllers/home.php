<?php
///////////////////////////////////////
// ホームコントローラー
///////////////////////////////////////
include_once '../config.php';
include_once '../util.php';
include_once '../Models/users.php';

// ログインチェック
$user = getUserSession();
if(!$user) {
    header('Location: ' .HOME_URL. 'Controllers/sign-in.php');
    exit;
}

// ユーザー情報を変更
if(isset($_POST['nickname']) && isset($_POST['name']) && isset($_POST['email'])) {
    $data = [
        'id' => $user['id'],
        'nickname' => $_POST['nickname'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'profile' => $_POST['profile']
    ];

    // パスワードの追加
    if(isset($_POST['password']) && $_POST['password'] !== '') {
        $data['password'] = $_POST['password'];
    }

    // 画像ファイルのアップロード
    if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $data['image_name'] = uploadImage($user, $FILES['image']);
    }

    if(updateUser($data)) {
        // 更新の実行->セッションに保存
        $user = findUser($user['id']);
        saveUserSession($user);

        header('Location: ' .HOME_URL. 'Controllers/home.php');
        exit;
    }
}

$view_acount = acountUser();

$view_user = $user;

include_once '../Views/home.php';