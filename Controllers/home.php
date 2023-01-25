<?php
///////////////////////////////////////
// ホームコントローラー
///////////////////////////////////////
include_once '../config.php';

// ログインチェック
$user = false;
if(!$user) {
    header('Location: ' .HOME_URL. 'Controllers/sign-in.php');
    exit;
}

include_once '../Views/home.php';