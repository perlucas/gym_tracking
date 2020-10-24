<?php

namespace Core\Config;
use flight\Engine;


class Configure
{
    /**
     * configures the framework
     *
     * @param Engine $framework
     * @return void
     */
    public static function configure(Engine $framework) {
        static::defineConstants();
        static::registerGlobalFunctions();
    }

    /**
     * defines the global constants to be used
     *
     * @return void
     */
    private static function defineConstants() {
        require __DIR__ . DIRECTORY_SEPARATOR . 'constants.php';
    }

    /**
     * defines the global functions to be used
     *
     * @return void
     */
    private static function registerGlobalFunctions() {
        require __DIR__ . DS . 'globals.php';
    }
}