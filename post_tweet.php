<?php
session_start();
require_once("lib/twitteroauth.php");
require_once("config.php");

//OAuthオブジェクトを生成する
$TwitterOAuth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

//呟きをPOSTするAPI
// $posted_tweet_json = $TwitterOAuth->OAuthRequest("https://api.twitter.com/1.1/statuses/update.json","POST",array("status" => $_POST['tweet']));
$posted_tweet_json = $TwitterOAuth->post('statuses/update', ['status' => $_POST['tweet']]);

//Jsonデータをオブジェクトに変更
$posted_tweet = json_decode($posted_tweet_json);

//エラー
if(isset($posted_tweet->{'errors'}) && $posted_tweet->{'errors'} != '') {
    echo '投稿に失敗しました';
}else{
    header('Location: index.php');
}
