## 1.Install
composer require --prefer-dist lulubin/yii2-oauth "dev-master"

## 2.Config
```php
'components' => [
    'authClientCollection' => [
        'class' => 'yii\authclient\Collection',
        'clients' => [
            'qq' => [
                'class' => 'lulubin\oauth\Qq',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'weixin' => [
                'class' => 'lulubin\oauth\Weixin',
                'clientId' => '***',
                'clientSecret' => '***',
            ],
            'weibo' => [
                'class' => 'lulubin\oauth\Weibo',
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
```php
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
<?php
use yii\helpers\Html;
use lulubin\oauth\assets\AuthChoiceAsset;
AuthChoiceAsset::register($this);
?>
<div class="form-group other-way">
	<?=Html::a('',['/site/auth','authclient'=>'qq'],['class'=>'qq'])?>
	<?=Html::a('',['/site/auth','authclient'=>'weibo'],['class'=>'weibo'])?>
	<?=Html::a('',['/site/auth','authclient'=>'weixin'],['class'=>'weixin'])?>
	<?=Html::a('',['/site/auth','authclient'=>'github'],['class'=>'github'])?>
</div>
```

## 4.申请上述第三方的 APP ID 和 APP KEY
（1）QQ互联：http://connect.qq.com/

（2）微信开放 平台：https://open.weixin.qq.com/

（3）新浪微博开放平台：http://open.weibo.com/

（4）Github Developer applications：https://github.com/settings/developers

QQ和微博的申请比较麻烦，时间久网站 需要备案；

Github的申请则十分迅速，建议先申请这个测试。
