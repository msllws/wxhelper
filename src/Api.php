<?php

namespace Lws;
class Api
{
    //构建url
    public static function build($config = []){
        $array = debug_backtrace();
        $func = $array[1]['function'];
        if(isset($config['app_id'])) $app_id = $config['app_id'];
        if(isset($config['app_secret'])) $app_secret = $config['app_secret'];
        if(isset($config['access_token'])) $access_token = $config['access_token'];
        if(isset($config['openid'])) $openid = $config['openid'];
        switch ($func){
            case 'getAccessToken': //获取access_token
                return 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='. $app_id .'&secret='. $app_secret;
            case 'pushMsg': //发送普通消息
                return 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='. $access_token;
            case 'pushTemp': //发送模板消息
                return 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='. $access_token;
            case 'shortUrl': //获取短网址
                return 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token='. $access_token;
            case 'userList': //获取用户列表
                $next_openid = null;
                if(isset($config['next_openid'])) $next_openid = $config['next_openid'];
                return 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='. $access_token .'&next_openid='. $next_openid;
            case 'userInfo': //获取用户信息
                return 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='. $access_token .'&openid='. $openid .'&lang=zh_CN';
            case 'usersInfo': //获取多个用户信息
                return 'https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token='. $access_token;
            case 'sendRedpack': //发普通红包
                return 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
            default:
                return '';
        }
    }

}
