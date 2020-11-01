<?php

namespace Core\Config;

use flight\Engine;
use Propel\Common\Config\ConfigurationManager;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Configure
{
    public static function configure(Engine $framework) {
        static::defineConstants();
        static::registerGlobalFunctions();
        static::loadPropelConfiguration();
        static::setPropelLogger();
        static::setTimezone();
    }

    private static function defineConstants() {
        require __DIR__ . DIRECTORY_SEPARATOR . 'constants.php';
    }

    private static function registerGlobalFunctions() {
        require __DIR__ . DS . 'globals.php';
    }

    private static function loadPropelConfiguration() {
        // Load the configuration file 
        $configManager = new ConfigurationManager( \pathJoin( [\rootDir(), 'config', 'propel.yaml'] ) );

        // Set up the connection manager
        $manager = new ConnectionManagerSingle();
        $manager->setConfiguration( $configManager->getConnectionParametersArray()['main'] );
        $manager->setName('main');

        // Add the connection manager to the service container
        $serviceContainer = Propel::getServiceContainer();
        $serviceContainer->setAdapterClass('main', 'mysql');
        $serviceContainer->setConnectionManager('main', $manager);
        $serviceContainer->setDefaultDatasource('main');
    }

    private static function setPropelLogger() {
        $logger = new Logger('defaultLogger');
        $logger->pushHandler(new StreamHandler( \pathJoin( [\rootDir(), 'logs', 'propel.log'] ) ));
        Propel::getServiceContainer()->setLogger('defaultLogger', $logger);
    }

    private static function setTimeZone() {
        \date_default_timezone_set(DEFAULT_TIMEZONE);
    }
}