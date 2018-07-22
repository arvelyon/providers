<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit38190a08ba3c5e85dc78024917021342
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Arvelyon\\Providers\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Arvelyon\\Providers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit38190a08ba3c5e85dc78024917021342::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit38190a08ba3c5e85dc78024917021342::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}