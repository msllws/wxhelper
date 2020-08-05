<?php

namespace Lws\Tools;
class Json
{
    //返回数组
    public static function toArr($arr)
    {
        return json_decode($arr,true);
    }

}
