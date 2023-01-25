<?php
///////////////////////////////////////
// ホームコントローラー
///////////////////////////////////////
include_once '../config.php';
include_once '../util.php';

// ログインチェック
$user = getUserSession();
if(!$user) {
    header('Location: ' .HOME_URL. 'Controllers/sign-in.php');
    exit;
}

include_once '../Views/home.php';