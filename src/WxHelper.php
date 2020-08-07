<?php

namespace Lws;
use Lws\Tools\Curl;
use Lws\Tools\Json;
use Lws\Tools\Com;
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

    //获取多个用户信息 最多100条
    public static function usersInfo($config,$data){
        $res = Curl::postCurl(Api::build($config), json_encode($data, JSON_UNESCAPED_UNICODE));
        return Json::toArr($res);
    }

    //发普通红包
    public static function sendRedpack($config,$data){
        $data['wxappid'] = $config['app_id'];
        $data['mch_id'] = $config['mch_id'];
        $data['client_ip'] = $_SERVER['REMOTE_ADDR']; //Ip地址
        $data['nonce_str'] = Com::strRand(); //随机32位字符串
        $sign = Com::wxSign($data,$config['api_key']);  //创建签名 apiKey为微信支付api秘钥
        $data['sign'] = $sign;
        $postXml = Com::arrayToXml($data);  //数组转xml
        $responseXml = Curl::postSsl(Api::build(),$postXml,$config['apiclient_cert'],$config['apiclient_key']);  //提交请求
        $res = Com::xmlToArr($responseXml); //xml转数组
        return $res;
    }
}
