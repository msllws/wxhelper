<?php

namespace Lws;
use Lws\Tools\Curl;
use Lws\Tools\Json;
use Lws\Api;
class WxHelper
{
    //获取access_token
    public static function getAccessToken($config)
    {
        $res =  Curl::getCurl(Api::build($config));
        return Json::toArr($res);
    }

    //发送模板消息
    public static function pushTemp($config, $openid, $template_id, $tempData, $url = '', $miniprogram = []){
        $data = [
            'touser' => $openid,
            'template_id' => $template_id,
            'data' => $tempData
        ];
        if(!empty($url)) $data['url'] = $url;
        if(!empty($miniprogram)) $data['miniprogram'] = $miniprogram;
        $res = Curl::postCurl(Api::build($config), json_encode($data, JSON_UNESCAPED_UNICODE));
        return Json::toArr($res);
    }
}
