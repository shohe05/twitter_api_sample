<?php
session_start();
session_destroy();
//セッション変数初期化
$_SESSION[''] = array();
header("Location: login.php?authorizeBoolean=2");
?>
