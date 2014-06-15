<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja">
<head>
  <title>twitter api test</title>
</head>
<body>
  <h2>つぶやく</h2>
  <form action="post_tweet.php" method='post'>
      <textarea name="tweet" cols="30" rows="10"></textarea>
      <input type="submit" value='つぶやく'>
  </form>

<?php
session_start();
require_once("lib/twitteroauth.php");
require_once("config.php");

//OAuthオブジェクトを生成する
$TwitterOAuth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

//home_timelineを取得するAPIを利用。Twitterからjson形式でデータが返ってくる
$timeline_json = $TwitterOAuth->OAuthRequest("https://api.twitter.com/1.1/statuses/home_timeline.json","GET",array("count"=>"10"));

//json形式のデータをPHPの連想配列に変換
$timeline = json_decode($timeline_json);

//オブジェクトを展開
if(isset($timeline->{'errors'}) && $timeline->{'errors'} != ''):
    echo 'エラーが発生しました';
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
