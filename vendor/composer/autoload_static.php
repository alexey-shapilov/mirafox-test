<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc597a24580d60c38fbaf8f2f8afdb78a
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MirafoxTest\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MirafoxTest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc597a24580d60c38fbaf8f2f8afdb78a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc597a24580d60c38fbaf8f2f8afdb78a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
