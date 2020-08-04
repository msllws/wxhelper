<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lws\BaseService;
use Lws\Api;
use Lws\Curl;
class Helper
{
    private $config;
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    public function getAccessToken()
    {
        $url = Api::ACCESS_TOKEN;
        $url = str_replace('APPID',$this->config['app_id'],$url);
        $url = str_replace('APPSECRET',$this->config['secret'],$url);
        $res = Curl::post($url);
        $res = json_decode($res,true);
        return $res['access_token'];
    }
}
