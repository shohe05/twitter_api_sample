<?php
session_start();
require_once('lib/twitteroauth.php');
require_once('config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Type" content="text/html;">
<title>Twitter OAuth Login</title>
</head>
<body>

<?php
//セッションのアクセストークンのチェック
if((isset($_SESSION['oauth_token']) && $_SESSION['oauth_token'] !== NULL) && (isset($_SESSION['oauth_token_secret']) && $_SESSION['oauth_token_secret'] !== NULL)):
    header('Location: index.php');
else:
    //OAuthオブジェクト生成
    $TwitterOAuth = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);

    //callback url を指定して request tokenを取得
    $TwitterOAuthToken = $TwitterOAuth->getRequestToken(OAUTH_CALLBACK);

    //セッション格納
    $_SESSION['request_token'] = $TwitterOAuthToken['oauth_token'];
    $_SESSION['request_token_secret'] = $TwitterOAuthToken['oauth_token_secret'];

    //認証URLの引数 falseの場合はtwitter側で認証確認表示
    $bAuthorizeBoolean = isset($_GET['authorizeBoolean']) && $_GET['authorizeBoolean'] != '' ? false : true;
    ?>
    <a href="<?php echo $TwitterOAuth->getAuthorizeURL($_SESSION['request_token'], $bAuthorizeBoolean); ?>">ログイン</a>

<?php endif; ?>
</body>
</html>
