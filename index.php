<?php

require 'vendor/autoload.php';

Flight::route('/', function() {
    Flight::render('layout');
});

Flight::start();