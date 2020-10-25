<?php

namespace Core\Controllers;

class HomeController extends BaseController
{
    /**
     * renders the /home page
     *
     * @return void
     */
    public function index() {
        $this->app->render('home/index', array(), 'bodyContent');

        $this->app->view()->set('bodyScripts', 
            array(
                'home/home.js'
            )
        );
        
        $this->app->render('layout');
    }
}