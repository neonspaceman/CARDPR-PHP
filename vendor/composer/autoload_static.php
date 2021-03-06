<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite9dd79ddba4a22af639c563ea34ee222
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\' => 6,
        ),
        'C' => 
        array (
            'Curl\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Tests',
        ),
        'Curl\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Curl',
        ),
    );

    public static $classMap = array (
        'ApiTests' => __DIR__ . '/../..' . '/src/ApiTests.php',
        'Curl\\Curl' => __DIR__ . '/../..' . '/src/Curl/Curl.php',
        'Curl\\Request' => __DIR__ . '/../..' . '/src/Curl/Request.php',
        'Curl\\Response' => __DIR__ . '/../..' . '/src/Curl/Response.php',
        'Tests\\Assert' => __DIR__ . '/../..' . '/src/Tests/Assert.php',
        'Tests\\Tests' => __DIR__ . '/../..' . '/src/Tests/Tests.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite9dd79ddba4a22af639c563ea34ee222::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite9dd79ddba4a22af639c563ea34ee222::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite9dd79ddba4a22af639c563ea34ee222::$classMap;

        }, null, ClassLoader::class);
    }
}
