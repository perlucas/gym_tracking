<?php

namespace Core\Controllers;

class HomeController extends BaseController
{
    /**
     * renders the /home page
     *
     * @return void
     */
    public function show() {
        $this->app->render('home/bodyContent', array(), 'bodyContent');

        $this->app->view()->set('bodyScripts', 
            array(
                'home/home.js'
            )
        );
        
        $this->app->view()->set('navLinks', 
            array(
                array('label' => 'Administración', 'link' => '/admin' )
            )
        );

        $this->app->render('layout');
    }
}