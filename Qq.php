<?php
namespace lulubin\oauth;

use yii\authclient\InvalidResponseException;
use yii\authclient\OAuth2;
use yii\httpclient\Request;
use yii\httpclient\Response;

class Qq extends OAuth2
{

    public $authUrl = 'https://graph.qq.com/oauth2.0/authorize';
    public $tokenUrl = 'https://graph.qq.com/oauth2.0/token';
    public $apiBaseUrl = 'https://graph.qq.com';

    public function init()
    {
        parent::init();
        if ($this->scope === null) {
            $this->scope = implode(',', [
                'get_user_info',
            ]);
        }
    }

    protected function initUserAttributes()
    {
        $openid =  $this->api('oauth2.0/me', 'GET');
        $qquser = $this->api("user/get_user_info", 'GET', ['oauth_consumer_key'=>$openid['client_id'], 'openid'=>$openid['openid']]);
        $qquser['openid']=$openid['openid'];
        $qquser['id']=$qquser['openid'];
        $qquser['username']=$qquser['nickname'];
        return $qquser;
    }

    protected function defaultName()
    {
        return 'QQ';
    }

    protected function defaultTitle()
    {
        return 'QQ';
    }

    /**
     * Sends the given HTTP request, returning response data.
     * @param \yii\httpclient\Request $request HTTP request to be sent.
     * @return array response data.
     * @throws InvalidResponseException on invalid remote response.
     * @since 2.1
     */
    protected function sendRequest($request)
    {
        $response = $request->send();

        if (!$response->getIsOk()) {
            throw new InvalidResponseException($response, 'Request failed with code: ' . $response->getStatusCode() . ', message: ' . $response->getContent());
        }

        $this->processResult($response);

        return $response->getData();
    }

    /**
     * @param Response $response
     */
    protected function processResult(Response $response)
    {
        $content = $response->getContent();
        if (strpos($content, "callback") !== 0) {
            return;
        }
        $lpos = strpos($content, "(");
        $rpos = strrpos($content, ")");
        $content = substr($content, $lpos + 1, $rpos - $lpos - 1);
        $content = trim($content);
        $response->setContent($content);
    }
}