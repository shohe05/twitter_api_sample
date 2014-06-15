<?php
session_start();
require_once("lib/twitteroauth.php");
require_once("config.php");

//OAuthオブジェクトを生成する
$TwitterOAuth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

//ログインしてるユーザーの情報取得
$userinfo = $TwitterOAuth->get('users/show', ['screen_name'=> $_SESSION['screen_name']]);

//home_timelineを取得するAPIを利用。Twitterからjson形式でデータが返ってくる
$tweets = $TwitterOAuth->get('statuses/user_timeline', ['screen_name'=> $_SESSION['screen_name']]);
?>
<a href="index.php">←トップへ</a><br>
<h3><?php echo $userinfo->{'screen_name'}; ?>のプロフィール</h3>
<img src="<?php echo $userinfo->{'profile_image_url'}; ?>" />
<ul>
  <li><?php echo $userinfo->{'name'} . '（@' . $userinfo->{'screen_name'} . '）';?></li>
  <li><?php echo $userinfo->{'description'};?></li>
</ul>

<h3>ツイート</h3>
<?php
foreach($tweets as $tweet): ?>
    <hr/>
    <ul>
      <li><?php echo $tweet->{'text'}; ?></li>
      <li><?php echo date('Y-m-d H:i:s', strtotime($tweet->{'created_at'})); ?></li>
    </ul>
<?php
endforeach;
