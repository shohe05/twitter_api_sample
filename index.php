<?php
session_start();
require_once("lib/twitteroauth.php");
require_once("config.php");

//OAuthオブジェクトを生成する
$TwitterOAuth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

//ログインしてるユーザーの情報取得
$userinfo = $TwitterOAuth->get('users/show', ['screen_name'=> $_SESSION['screen_name']]);

//home_timelineを取得するAPIを利用。Twitterからjson形式でデータが返ってくる
$timeline = $TwitterOAuth->get('statuses/home_timeline', ['count'=>'10']);
?>

<html lang="ja">
<head>
  <title>twitter api test</title>
</head>
<body>

  <h3>ログインしているユーザー</h3>
  <img src="<?php echo $userinfo->{'profile_image_url'}; ?>" />
  <?php echo $userinfo->{'name'}; ?>
  <a href="profile.php">プロフィールをみる</a>

  <h3>つぶやく</h3>
  <form action="post_tweet.php" method='post'>
      <textarea name="tweet" cols="30" rows="10"></textarea>
      <input type="submit" value='つぶやく'>
  </form>

  <?php
  //オブジェクトを展開
if($timeline->{'errors'}):
    echo $timeline->{'errors'}->{'message'};
else:
  foreach($timeline as $tweet): ?>
      <hr/>
      <h4><?php echo $tweet->{'user'}->{'name'}; ?></h4>
      <ul>
        <li><img src="<?php echo $tweet->{'user'}->{'profile_image_url'}; ?>" /></li>
        <li><?php echo $tweet->{'text'}; ?></li>
        <li><?php echo date('Y-m-d H:i:s', strtotime($tweet->{'created_at'})); ?></li>
      </ul>
  <?php
  endforeach;
endif;
  ?>
</body>
</html>
