<?php

namespace Lws;

/**
 * curl访问网络类
 * @author lee
 *
 */
class Curl
{

    public static function get($url, $referer = '', $cookie = false, $headers = false, $retHeader = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 10000); //尝试连接等待的时间，以毫秒为单位。设置为0，则无限等待。
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 10000);    //设置cURL允许执行的最长毫秒数
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 获取数据返回

        //referer
        if ($referer) {
            curl_setopt($ch, CURLOPT_REFERER, $referer);
        }
        //返回头部信息
        if ($retHeader) {
            curl_setopt($ch, CURLOPT_HEADER, true);
        } else {
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
        }
        //请求头
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        //cookie
        if ($cookie) {
            curl_setopt($ch, CURLOPT_COOKIE, "Tuwan_Passport=" . $_COOKIE['Tuwan_Passport']);
        }
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }


    /**
     * 伪造IP请求
     * @param unknown $url
     * @param string $cookie
     * @param string $ip
     * @return mixed
     */
    public static function getHttps($url, $ip = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 10000); //尝试连接等待的时间，以毫秒为单位。设置为0，则无限等待。
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 10000);    //设置cURL允许执行的最长毫秒数
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        if ($ip) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:' . $ip, 'CLIENT-IP:' . $ip));
        }

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    public static function httpRequest($url, $data=[])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    /**
     * GET 请求
     * @param string $url
     */
    public static function getNewHttp($url)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * 获取URL，code
     * @param string $url
     */
    public static function getCode($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 2000);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
        curl_setopt($ch, CURLOPT_URL, $url); //设置URL
        curl_setopt($ch, CURLOPT_HEADER, 1); //获取Header
        curl_setopt($ch, CURLOPT_NOBODY, true); //Body就不要了吧，我们只是需要Head
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //数据存到成字符串吧，别给我直接输出到屏幕了
        $data = curl_exec($ch); //开始执行啦～
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE); //我知道HTTPSTAT码哦～
        curl_close($ch); //用完记得关掉他

        return $code;
    }

    /**
     * post提交
     * @param string $url 请求链接
     * @param array/string/json $data 请求数据
     * @param array $headers 请求头
     * @param array $timeout 超时时间
     * @param array $cookie 是否带cookie请求
     * @param array $retHeader 是否返回头部信息
     */
    public static function post($url, $data = array(), $headers = array(), $timeout = 10000, $retHeader = false)
    {
        if(isset($data['method'])){
            LogJd($data['method'], $data);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);
        curl_setopt($ch, CURLOPT_URL, $url);

        //返回头部信息
        if ($retHeader) {
            curl_setopt($ch, CURLOPT_HEADER, true);
        } else {
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        //请求头
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        //https
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }

        $output = curl_exec($ch);
        curl_close($ch);
        if(isset($data['method'])){
            LogJd($data['method'], json_decode($output));
        }

        return $output;
    }

    /**
     * post json
     * @param unknown $url
     * @param unknown $json
     * @param unknown $headers
     * @return mixed
     */
    public static function postJson($url, $json, $headers = [], $timeout = 10000)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }

        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}