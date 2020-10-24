<?php

namespace Core\Controllers;
use flight\Engine;

class HomeController extends BaseController
{
    /**
     * renders the /home page
     *
     * @return void
     */
    public function home() {
        $this->app->render('home/bodyContent', array(), 'bodyContent');
        $this->app->render('layout',
            [
                'bodyScripts' => [
                    'home/home.js'
                ]
            ]
        );
    }
}