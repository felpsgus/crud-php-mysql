<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4310a2467e96abd2d8c6e2faf33fef52
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4310a2467e96abd2d8c6e2faf33fef52::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4310a2467e96abd2d8c6e2faf33fef52::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4310a2467e96abd2d8c6e2faf33fef52::$classMap;

        }, null, ClassLoader::class);
    }
}