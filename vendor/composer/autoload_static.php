<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7b537f004057b7c9ccfbabdb13553516
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mike42\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mike42\\' => 
        array (
            0 => __DIR__ . '/..' . '/mike42/escpos-php/src/Mike42',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7b537f004057b7c9ccfbabdb13553516::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7b537f004057b7c9ccfbabdb13553516::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7b537f004057b7c9ccfbabdb13553516::$classMap;

        }, null, ClassLoader::class);
    }
}
