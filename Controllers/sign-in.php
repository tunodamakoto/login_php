<?php
///////////////////////////////////////
// サインインコントローラー
///////////////////////////////////////
include_once '../config.php';
include_once '../util.php';
include_once '../Models/users.php';

$try_login_result = null;

// ログイン実行
if(isset($_POST['email']) && isset($_POST['password'])) {
    
    // ログイン情報をサーバーから取得（パスワードチェック）
    $user = findUserAndCheckPassword($_POST['email'], $_POST['password']);

    if($user) {
        // ログイン成功
        saveUserSession($user);
        header('Location: ' .HOME_URL. 'Controllers/home.php');
        exit;
    } else {
        // ログイン失敗
        $try_login_result = false;
    }
}

$view_try_login_result = $try_login_result;

include_once '../Views/sign-in.php';