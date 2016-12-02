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
use yii\helpers\Html;
use lulubin\oauth\assets\AuthChoiceAsset;
AuthChoiceAsset::register($this);
<div class="form-group other-way">
	<?=Html::a('',['/site/auth','authclient'=>'qq'],['class'=>'qq'])?>
	<?=Html::a('',['/site/auth','authclient'=>'weibo'],['class'=>'weibo'])?>
	<?=Html::a('',['/site/auth','authclient'=>'weixin'],['class'=>'weixin'])?>
	<?=Html::a('',['/site/auth','authclient'=>'github'],['class'=>'github'])?>
</div>
```