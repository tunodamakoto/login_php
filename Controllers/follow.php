<?php
///////////////////////////////////////
// フォローコントローラー
///////////////////////////////////////
include_once '../config.php';
include_once '../util.php';
include_once '../Models/follows.php';

// ログインチェック
$user = getUserSession();
if(!$user) {
    header('Location: ' .HOME_URL. 'Controllers/sign-in.php');
    exit;
}

$follow_id = null;

// フォローする
if(isset($_POST['followed_user_id'])) {
    $data = [
        'followed_user_id' => $_POST['followed_user_id'],
        'follow_user_id' => $user['id'],
    ];
    // フォロー登録
    $follow_id = createFollow($data);
}

// フォローを外す
if(isset($_POST['follow_id'])) {
    $data = [
        'follow_id' => $_POST['follow_id'],
        'follow_user_id' => $user['id'],
    ];
    // フォロー削除
    deleteFollow($data);
}

// JSON形式で結果を返却
$res = [
    'message' => 'successful',
    'follow_id' => $follow_id,
];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($res);