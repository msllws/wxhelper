<?php

namespace Lws;

class WxHelper
{

    public static function test()
    {
        return "This is Wxhelper test";
    }

    /**
     * @param string $name
     * @param array  $config
     *
     * @return \EasyWeChat\Kernel\ServiceContainer
     */
    public static function route($name, array $config)
    {
        $application = "\\Lws\\{$name}\\Helper";
        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::route($name, ...$arguments);
    }

}
