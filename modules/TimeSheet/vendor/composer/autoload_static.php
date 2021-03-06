<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit55c8067cf4c62ae79bbd095b97141a1b
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\TimeSheet\\Models\\' => 25,
            'Modules\\TimeSheet\\Controllers\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\TimeSheet\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Modules\\TimeSheet\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit55c8067cf4c62ae79bbd095b97141a1b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit55c8067cf4c62ae79bbd095b97141a1b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit55c8067cf4c62ae79bbd095b97141a1b::$classMap;

        }, null, ClassLoader::class);
    }
}
