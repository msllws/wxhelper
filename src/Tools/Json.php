<?php

namespace Lws\Tools;
class Json
{
    //返回数组
    public static function toArr($arr)
    {
        if(is_string($arr)){
            return json_decode($arr,true);
        }else{
            return [];
        }
    }
}
