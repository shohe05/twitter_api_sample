<?php
session_start();
require_once('lib/twitteroauth.php');
require_once('config.php');

//URLパラメータからoauth_verifierを取得
if(isset($_GET['oauth_verifier']) && $_GET['oauth_verifier'] != ''){
    $oauth_verifier = $_GET['oauth_verifier'];
}else{
    echo 'エラーが発生しました';
    exit;
}

//リクエストトークンでOAuthオブジェクト生成
$TwitterOAuth = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION['request_token'],$_SESSION['request_token_secret']);

//oauth_verifierを使ってAccess tokenを取得
$TwitterOAuthToken = $TwitterOAuth->getAccessToken($oauth_verifier);

//取得した値をSESSIONに格納
$_SESSION['oauth_token'] = $TwitterOAuthToken['oauth_token'];
$_SESSION['oauth_token_secret'] = $TwitterOAuthToken['oauth_token_secret'];
$_SESSION['user_id'] = $TwitterOAuthToken['user_id'];
$_SESSION['screen_name'] = $TwitterOAuthToken['screen_name'];
header("Location: index.php");
?>
