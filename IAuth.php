<?php

namespace lulubin\oauth;

/**
 * Oauth Interface
 */
interface IAuth
{

    /**
     *
     * @return []
     */
    public function getUserInfo();

    /**
     *
     * @return mixed
     */
    public function getOpenid();
}
