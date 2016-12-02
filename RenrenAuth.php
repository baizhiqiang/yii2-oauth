<?php

namespace lulubin\oauth;

use yii\authclient\OAuth2;

/**
 * Renren OAuth
 * @see http://wiki.dev.renren.com/wiki/Authentication
 */
class RenrenAuth extends OAuth2
{

    /**
     * @inheritdoc
     */
    public $authUrl = 'https://graph.renren.com/oauth/authorize';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://graph.renren.com/oauth/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.renren.com';

    /**
     * Try to use getUserAttributes to get simple user info
     * @see http://wiki.dev.renren.com/wiki/Authentication
     *
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->getAccessToken()->getParams()['user'];
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'renren';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Renren';
    }

}
