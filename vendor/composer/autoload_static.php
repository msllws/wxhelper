<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3a6affa3e5cf2c6ed36b1ed02a932156
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lws\\Wxhelper\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lws\\Wxhelper\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Lws/Wxhelper',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3a6affa3e5cf2c6ed36b1ed02a932156::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3a6affa3e5cf2c6ed36b1ed02a932156::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
