<?php
namespace lulubin\oauth\assets;

use yii\web\AssetBundle;

class AuthChoiceAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@lulubin/oauth/assets';
    public $css = ['authchoice.css'];
    public $depends = ['yii\web\YiiAsset',];
}
