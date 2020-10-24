<?php

require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Config\Configure;
use Core\Config\Router;
use flight\Engine;

$app = new Engine();

Configure::configure($app);

Router::configureRoutes($app);

$app->start();