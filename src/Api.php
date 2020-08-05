<?php

namespace Lws;
class Api
{
    //构建url
    public static function build($config){
        //获取调用该方法的方法名
        $array = debug_backtrace();
        $func = $array[1]['function'];

        if(isset($config['app_id'])) $app_id = $config['app_id'];
        if(isset($config['app_secret'])) $app_secret = $config['app_secret'];
        if(isset($config['access_token'])) $access_token = $config['access_token'];
        
        switch ($func){
            case 'getAccessToken': //获取access_token
                return 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='. $app_id .'&secret='. $app_secret;
            case 'pushTemp': //发送模板消息
                return 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='. $access_token;
            default:
                return '';
        }
    }

}
