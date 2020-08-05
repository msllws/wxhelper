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

    //发送普通消息
    public static function pushMsg($config, $data)
    {
        $res = Curl::postCurl(Api::build($config), json_encode($data, JSON_UNESCAPED_UNICODE));
        return Json::toArr($res);
    }

    //发送模板消息
    public static function pushTemp($config, $data){
        $res = Curl::postCurl(Api::build($config), json_encode($data, JSON_UNESCAPED_UNICODE));
        return Json::toArr($res);
    }

    //获取短网址
    public static function shortUrl($config,$data){
        $res = Curl::postCurl(Api::build($config), json_encode($data, JSON_UNESCAPED_UNICODE));
        return Json::toArr($res);
    }

    //获取用户列表
    public static function userList($config){
        $res =  Curl::getCurl(Api::build($config));
        return Json::toArr($res);
    }

    //获取用户信息
    public static function userInfo($config){
        $res =  Curl::getCurl(Api::build($config));
        return Json::toArr($res);
    }

    //获取多个用户信息 每次最多100条
    public static function usersInfo($config,$data){
        $res = Curl::postCurl(Api::build($config), json_encode($data, JSON_UNESCAPED_UNICODE));
        return Json::toArr($res);
    }
}
