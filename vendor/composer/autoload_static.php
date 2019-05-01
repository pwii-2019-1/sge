<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2037c32e53e82aafd6d754e5434f532
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'sge\\' => 4,
        ),
        'c' => 
        array (
            'core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'sge\\' => 
        array (
            0 => __DIR__ . '/../..' . '/public_html',
        ),
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $classMap = array (
        'core\\CRUD' => __DIR__ . '/../..' . '/core/CRUD.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2037c32e53e82aafd6d754e5434f532::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2037c32e53e82aafd6d754e5434f532::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc2037c32e53e82aafd6d754e5434f532::$classMap;

        }, null, ClassLoader::class);
    }
}