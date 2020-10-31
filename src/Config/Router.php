<?php

namespace Core\Config;
use flight\Engine;

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

        $app->route(
            'GET /', 
            function () use ($app) { $app->redirect('/home');}
        );

        $app->route(
            'GET /home', 
            array( static::getController('home') , 'index')
        );

        $app->route(
            'POST /attendance(/@trainee_id:[0-9]+)',
            array( static::getController('attendance'), 'createForTrainee' )
        );

        $app->route(
            'GET /attendance/export',
            array( static::getController('attendance'), 'exportForm' )
        );

        $app->route(
            'GET /trainee/new',
            array( static::getController('trainee'), 'createForm' )
        );
        
        $app->route(
            'POST /trainee/new',
            array ( static::getController('trainee'), 'storeTrainee' )
        );
        
        $app->route(
            'GET /trainee/export',
            array( static::getController('trainee'), 'exportForm' )
        );

        /* API endpoints */

        $app->route(
            'GET /api/v1/trainees',
            array( static::getController('trainee'), 'fetchTrainees' )
        );
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