twitter_api_sample
==================

[abraham/twitteroauth]: https://github.com/abraham/twitteroauth "abraham/twitteroauth"
[abraham/twitteroauth][]を用いてTwitterの認証やツイートなどをしてみるサンプルです。

## 使い方

1. config-sample.phpをconfig.phpにリネーム

2. config.phpを編集

```php
    define('CONSUMER_KEY', 'YOUR APP CONSUMER_KEY');
    define('CONSUMER_SECRET', 'YOUR APP CONSUMER_SECRET');
    define('OAUTH_CALLBACK', 'YOUR APP CALLBACK_URL');
```

事前にTwitterに登録した諸々のキーやコールバックURLを入力。

以上の設定が終わったらindex.phpにアクセス。
