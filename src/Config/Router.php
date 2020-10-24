<?php

namespace Core\Config;
use flight\Engine;

// use Core\Controllers\HomeController;

class Router
{
    /**
     * framework instance
     *
     * @var Engine
     */
    protected static $app = null;

    /**
     * map of controllers using their aliases
     *
     * @var array
     */
    protected static $controllersByAlias = [];

    /**
     * configures the routes of the web app
     *
     * @param Engine $app
     * @return void
     */
    public static function configureRoutes(Engine $app) {

        static::$app = $app;

        $app->route('/', function () use ($app) {
            $app->redirect('/home');
        });

        $app->route('/home', array( static::getController('home') , 'home'));

    }

    /**
     * returns or instantiates the controller
     *
     * @param string $alias
     * @return object controller class
     */
    private static function getController($alias) {
        if (! \array_key_exists($alias, static::$controllersByAlias)) {
            $className = "Core\\Controllers\\" . \ucfirst($alias) . 'Controller';

            static::$controllersByAlias[$alias] = new $className( static::$app );
        }
        
        return static::$controllersByAlias[$alias];
    }
}