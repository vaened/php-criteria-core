<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit59891d04185114e1dee2e5d579a7a4a3
{
    public static $files = array (
        '5a9a47df40faeec763abad5884a66ee2' => __DIR__ . '/..' . '/lambdish/phunctional/src/_bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vaened\\Support\\' => 15,
            'Vaened\\CriteriaCore\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vaened\\Support\\' => 
        array (
            0 => __DIR__ . '/..' . '/vaened/support/src',
        ),
        'Vaened\\CriteriaCore\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit59891d04185114e1dee2e5d579a7a4a3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit59891d04185114e1dee2e5d579a7a4a3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit59891d04185114e1dee2e5d579a7a4a3::$classMap;

        }, null, ClassLoader::class);
    }
}