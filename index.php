<?php

require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Config\Configure;
use Core\Config\Router;
use flight\Engine;

if (! session_id()) {
    session_start();
}

$app = new Engine();

Configure::configure($app);

Router::configureRoutes($app);

$app->start();