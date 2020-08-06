# 微信开发助手 wxhelper

### 安装
```
composer require liweishan/wxhelper 1.0
```

### 示例

(更新中......)

```php
<?php
namespace app\index\controller;
use Lws\WxHelper;
class Test
{
    private $config;
    public function __construct()
    {
        $this->config = [
            'app_id' => 'xxx', //APPID
            'app_secret' => 'xxx', //APPSECRET
            'mch_id' => 123, //商户号
            'api_key' => 'xxx', //微信支付api秘钥
            'apiclient_cert' => ROOT_PATH . '/public/cert/apiclient_cert.pem',
            'apiclient_key' => ROOT_PATH . '/public/cert/apiclient_key.pem',
        ];

        //获取access_token
        $this->config['access_token'] = WxHelper::getAccessToken($this->config)['access_token'];

//        {"access_token":"35_soLbaOjtcuA-TbZVEsl0DCsbpZQgEPLCbu3I_xilf1UKUCMds0KGnLZqNJM9V6_2G7y04GKJLVaiQBsUeFqCbD1OQI8fjDsZDOVXQ407DDIrwbDq68WJbmWO7dvB1hD9Z3aKHd2Kb7ZFJB2DFYAcABAXQS","expires_in":7198}
    }

    //推送模板消息
    public function pushTemp()
    {
        $data = [
            'touser' => 'oFkK_syZ8IJWz34zfJkGgwRt5ML0',
            'template_id' => 'nNO_P5_PhUBXCM4jBRBHMbxV26Upq9DAwy-rjynFWic',
            'url' => 'https://www.baidu.com',
//            'miniprogram' => [],
            'data' => [
                'first' => ['value' => '您收到了一条新的订单test', 'color' => '#FF0000'],
                'tradeDateTime' => ['value' => date('Y年m月d日 H:i:s', time())],
                'orderType' => ['value' => '购买商品'],
                'customerInfo' => ['value' => '李维山', 'color' => '#173177'],
                'orderItemName' => ['value' => '订单号'],
                'orderItemData' => ['value' => '987654321'],
                'remark' => ['value' => '备注：123456789'],
            ]
        ];
        $res = WxHelper::pushTemp($this->config, $data);
        return json($res);
//        {"errcode":0,"errmsg":"ok","msgid":1459899482648428548}
    }

    //发送普通消息
    public function pushMsg()
    {
        $data = [
            "title" => "xxx",
            "description" => "xxx",
            "url" => "xxx",
            "thumb_url" => "xxx"
        ];
        $array = [
            "touser" => 'oFkK_syZ8IJWz34zfJkGgwRt5ML0',
            "msgtype" => "link",
            "link" => $data
        ];
        $res = WxHelper::pushMsg($this->config, $array);
        return json($res);
        //最近有互动返回 {"errcode":0,"errmsg":"ok"}，否则返回 {"errcode":45015,"errmsg":"response out of time limit"}
    }

    //获取短网址
    public function shortUrl()
    {
        $data = [
            'action' => 'long2short',
            'long_url' => 'xxx',
        ];
        $res = WxHelper::shortUrl($this->config, $data);
        return json($res);
//        {"errcode":0,"errmsg":"ok","short_url":"https:\/\/w.url.cn\/s\/ASrHBMw"}
    }

    //获取用户列表
    public function userList(){
        $res = WxHelper::userList($this->config);
        return json($res);
//        {"total":4,"count":4,"data":{"openid":["oFkK_s_XiOQd9JqV2JEyaSuDXF-E","oFkK_s6a9EylZ8HwHvz92iLzoL1M","oFkK_syZ8IJWz34zfJkGgwRt5ML0","oFkK_s4uIuQyLxNVOg-0BaOOaG5g"]},"next_openid":"oFkK_s4uIuQyLxNVOg-0BaOOaG5g"}
    }

    //获取用户信息
    public function userInfo(){
        $this->config['openid'] = 'oFkK_s4uIuQyLxNVOg-0BaOOaG5g';
        $res = WxHelper::userInfo($this->config);
        return json($res);
//        {"subscribe":1,"openid":"oFkK_syZ8IJWz34zfJkGgwRt5ML0","nickname":"ABCDEFG","sex":1,"language":"zh_CN","city":"廊坊","province":"河北","country":"中国","headimgurl":"http:\/\/thirdwx.qlogo.cn\/mmopen\/X9uAyMJakoXiaDMXVibIpMPMvmqMZsuwG8aRibYe0QvBicrBcAOnVJ39hrrHcX2rZsDXa62cwWtAwKo2WW6zib9YPgAEwasiaUjtFF\/132","subscribe_time":1596164079,"remark":"","groupid":0,"tagid_list":[],"subscribe_scene":"ADD_SCENE_SEARCH","qr_scene":0,"qr_scene_str":""}
    }

    //获取多个用户信息 每次最多100条
    public function usersInfo(){
        $data['user_list'] = [
            ['openid'=>'oFkK_syZ8IJWz34zfJkGgwRt5ML0'],
            ['openid'=>'oFkK_s_XiOQd9JqV2JEyaSuDXF-E'],
        ];
        $res = WxHelper::usersInfo($this->config,$data);
        return json($res);
//        {"user_info_list":[{"subscribe":1,"openid":"oFkK_syZ8IJWz34zfJkGgwRt5ML0","nickname":"ABCDEFG","sex":1,"language":"zh_CN","city":"廊坊","province":"河北","country":"中国","headimgurl":"http:\/\/thirdwx.qlogo.cn\/mmopen\/X9uAyMJakoXiaDMXVibIpMPMvmqMZsuwG8aRibYe0QvBicrBcAOnVJ39hrrHcX2rZsDXa62cwWtAwKo2WW6zib9YPgAEwasiaUjtFF\/132","subscribe_time":1596164079,"remark":"","groupid":0,"tagid_list":[],"subscribe_scene":"ADD_SCENE_SEARCH","qr_scene":0,"qr_scene_str":""},{"subscribe":1,"openid":"oFkK_s_XiOQd9JqV2JEyaSuDXF-E","nickname":"漫枝莹雪","sex":2,"language":"zh_CN","city":"","province":"北岸","country":"新西兰","headimgurl":"http:\/\/thirdwx.qlogo.cn\/mmopen\/OYq7h2GKrNvficRFibZ64L82KSf30c4f5azYB8eZQgWx5PKlfI8iaavMW0oZnBTJbeibpZiajbOe3szRuAJ9GWjx7fIgXy3DuNQ6d\/132","subscribe_time":1584704688,"remark":"","groupid":0,"tagid_list":[],"subscribe_scene":"ADD_SCENE_PROFILE_CARD","qr_scene":0,"qr_scene_str":""}]}
    }

    //发送红包
    public function sendRedpack(){
        $data = [
            'mch_billno' => date('YmdHis').rand(1000,9999), //商户订单号
            're_openid' => 'oFkK_syZ8IJWz34zfJkGgwRt5ML0', //用户openid
            'total_amount' => '100', //金额 最低1元，单位分
            'total_num' => 1, //发放总人数
            'send_name' => '老狗专属', //商户名称
            'wishing' => '送你一只老狗', //祝福语
            'act_name' => '测试红包', //活动名称
            'remark' => '测试红包', //备注
        ];
        $res = WxHelper::sendRedpack($this->config, $data);
        return json($res);
//        {"return_code":"SUCCESS","return_msg":"发放成功","result_code":"SUCCESS","err_code":"SUCCESS","err_code_des":"发放成功","mch_billno":"202008051818519372","mch_id":"1581065031","wxappid":"wx0ef999318339527f","re_openid":"oFkK_s4uIuQyLxNVOg-0BaOOaG5g","total_amount":"100","send_listid":"1000041701202008053007539759300"}
    }
}

```