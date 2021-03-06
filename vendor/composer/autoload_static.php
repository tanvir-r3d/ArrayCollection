<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3d2d0d3944e8890ebcf511b1e7d6bfeb
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tanvir3d\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tanvir3d\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit3d2d0d3944e8890ebcf511b1e7d6bfeb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3d2d0d3944e8890ebcf511b1e7d6bfeb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3d2d0d3944e8890ebcf511b1e7d6bfeb::$classMap;

        }, null, ClassLoader::class);
    }
}
