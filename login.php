<?php
session_start();
require_once('lib/twitteroauth.php');
require_once('config.php');
?>

<?php
//セッションのアクセストークンのチェック
if($_SESSION['oauth_token']):
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
