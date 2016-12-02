## 1.Install
```
composer require --prefer-dist lulubin/yii2-oauth "dev-master"
```

## 2.Config
```
'components' => [
    'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
            'qq' => [
                'class' => 'lulubin\oauth\QqAuth',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'weibo' => [
                'class' => 'lulubin\oauth\WeiboAuth',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'weixin' => [
                'class' => 'lulubin\oauth\WeixinAuth',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'renren' => [
                'class' => 'lulubin\oauth\RenrenAuth',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'douban' => [
                'class' => 'lulubin\oauth\DoubanAuth',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'weixin-mp' => [
                'class' => 'lulubin\oauth\WeixinMpAuth',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'amazon' => [
                'class' => 'lulubin\oauth\AmazonAuth',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => '***',
                    'clientSecret' => '***,
                ],
        ]
    ]
]
```

## 3.Usage

### Controller
```
class SiteController extends Controller
{
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    public function successCallback($client)
    {
        $id = $client->getId();
        $attributes = $client->getUserAttributes();
        var_dump($id, $attributes);
    }
}
```

### View
```
<?= yii\authclient\widgets\AuthChoice::widget([
    'baseAuthUrl' => ['site/auth'],
    'popupMode' => false,
])
?>
```

### WeixinMp
```
$weixinMp = Yii::$app->authClientCollection->getClient('weixin-mp');

// http://mp.weixin.qq.com/wiki/11/0e4b294685f817b95cbed85ba5e82b8f.html
// getAccessToken
$accessTokenResult = $weixinMp->getMpAccessToken();
if ($accessTokenResult->validate()) {
    $accessTokenResult->access_token;
    $accessTokenResult->expires_in;
    $accessTokenResult->getAccessToken(); // WeixinMpToken
} else {
    var_dump($accessTokenResult->getErrCodeText());
    var_dump($accessTokenResult->getErrors());
}

// http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html#.E8.8E.B7.E5.8F.96api_ticket
// getTicket
$accessTokenResult = $weixinMp->getMpAccessToken();
$ticketType = 'jsapi'; // wx_card
$ticketResult = $weixinMp->getTicket($accessTokenResult->access_token, $ticketType);
if ($ticketResult->validate()) {
    $accessTokenResult->ticket; // TicketString
} else {
    var_dump($ticketResult->getErrCodeText());
    var_dump($ticketResult->getErrors());
}
```