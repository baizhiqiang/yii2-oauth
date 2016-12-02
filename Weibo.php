<?php

namespace lulubin\oauth;

use yii\authclient\OAuth2;

/**
 * Sina Weibo OAuth
 */
class Weibo extends OAuth2
{

    public $authUrl = 'https://api.weibo.com/oauth2/authorize';
    public $tokenUrl = 'https://api.weibo.com/oauth2/access_token';
    public $apiBaseUrl = 'https://api.weibo.com';

    /**
     *
     * @return []
     * @see http://open.weibo.com/wiki/Oauth2/get_token_info
     * @see http://open.weibo.com/wiki/2/users/show
     */
    protected function initUserAttributes()
    {
        $openid = $this->api('oauth2/get_token_info', 'POST');
        return $this->api("2/users/show.json", 'GET', ['uid' => $openid['uid']]);
    }

    protected function defaultName()
    {
        return 'Weibo';
    }

    protected function defaultTitle()
    {
        return 'Weibo';
    }

}