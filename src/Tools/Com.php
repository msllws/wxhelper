<?php

namespace Lws\Tools;
class Com
{
    //生成随机字符串，默认32位
    public static function strRand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        if (!is_int($length) || $length < 0) {
            return false;
        }
        $string = '';
        for ($i = $length; $i > 0; $i--) {
            $string .= $char[mt_rand(0, strlen($char) - 1)];
        }
        return $string;
    }

    //生成微信签名
    public static function wxSign($arr,$apiKey,$is_urlencode=false) {
        $sign = "";
        ksort($arr); //对数组参数按照字母a->z排序
        foreach ($arr as $k=>$v) {
            if(null!=$v && "null" != $v && "sign" != $k) {  //签名不要转码
                if ($is_urlencode) {
                    $v = urlencode($v);
                }
                $sign.=$k."=".$v."&";
            }
        }
        if (strlen($sign)>0) {
            $sign = substr($sign,0,strlen($sign)-1); //去掉末尾符号“&”
        }
        $sign .= '&key=' . $apiKey; //签名后加api秘钥
        $sign = strtoupper(md5($sign)); //签名加密并大写
        return $sign;
    }

    //数组转xml
    public static function arrayToXml($arr) {
        $xml = "<xml>";
        foreach ($arr as $key=>$val) {
            if (is_numeric($val)) {
                $xml.="<".$key.">".$val."</".$key.">";
            } else {
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    //XML转Array
    public static function xmlToArr($xml)
    {
        $obj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $str = json_encode($obj);
        $arr = json_decode($str, true);
        return $arr;
    }
}
