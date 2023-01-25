<?php
///////////////////////////////////////
// サインアップコントローラー
///////////////////////////////////////
include_once '../config.php';
include_once '../Models/users.php';

// アカウント登録
if(isset($_POST['nickname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $data = [
        'nickname' => $_POST['nickname'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];
    
    // ユーザー作成
    if(createUser($data)) {
        header('Location: ' .HOME_URL. 'Controllers/sign-in.php');
        exit;
    }
}

include_once '../Views/sign-up.php';