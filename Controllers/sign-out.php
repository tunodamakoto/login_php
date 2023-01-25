<?php
///////////////////////////////////////
// サインアウトコントローラー
///////////////////////////////////////
include_once '../config.php';
include_once '../util.php';

// ユーザー情報をセッションから削除
deleteUserSession();

header('Location: ' .HOME_URL. 'Controllers/sign-in.php');
exit;