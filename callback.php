<?php
session_start();
require_once('lib/twitteroauth.php');
require_once('config.php');

//URLパラメータからoauth_verifierを取得
if(isset($_GET['oauth_verifier']) && $_GET['oauth_verifier'] != ''){
    $sVerifier = $_GET['oauth_verifier'];
}else{
    echo 'oauth_verifier error!';
    exit;
}

//リクエストトークンでOAuthオブジェクト生成
$oOauth = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET,$_SESSION['requestToken'],$_SESSION['requestTokenSecret']);

//oauth_verifierを使ってAccess tokenを取得
$oAccessToken = $oOauth->getAccessToken($sVerifier);

//取得した値をSESSIONに格納
$_SESSION['oauthToken'] =             $oAccessToken['oauth_token'];
$_SESSION['oauthTokenSecret'] =     $oAccessToken['oauth_token_secret'];
$_SESSION['userId'] =                 $oAccessToken['user_id'];
$_SESSION['screenName'] =             $oAccessToken['screen_name'];

//loginページへリダイレクト
header("Location: login.php");
?>
