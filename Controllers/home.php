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
        $data['image_name'] = uploadImage($user, $_FILES['image']);
    }

    if(updateUser($data)) {
        // 更新の実行->セッションに保存
        $user = findUser($user['id']);
        saveUserSession($user);

        header('Location: ' .HOME_URL. 'Controllers/home.php');
        exit;
    }
}

// アカウントがクリックされたら
$requested_user_id = $user['id'];
if(isset($_GET['user_id'])) {
    $requested_user_id = $_GET['user_id'];
}

$view_acount = acountUser($user['id']);

$view_user = $user;

$view_requested_user = findUser($requested_user_id, $user['id']);

include_once '../Views/home.php';