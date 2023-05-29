<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit654aebadcaf14f12e8fca61d1dd62d17
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit654aebadcaf14f12e8fca61d1dd62d17::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit654aebadcaf14f12e8fca61d1dd62d17::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit654aebadcaf14f12e8fca61d1dd62d17::$classMap;

        }, null, ClassLoader::class);
    }
}
