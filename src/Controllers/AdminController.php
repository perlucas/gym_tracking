<?php

namespace Core\Controllers;

class AdminController extends BaseController
{
    /**
     * renders the /admin page
     *
     * @return void
     */
    public function show() {
        $this->app->render('admin/bodyContent', array(), 'bodyContent');
        
        $this->app->view()->set('navLinks', 
            array(
                array('label' => 'Inicio', 'link' => '/home' ),
                array('label' => 'Exportar registros', 'link' => '/attendance/export' ),
                array('label' => 'Exportar personas', 'link' => '#' )
            )
        );

        $this->app->render('layout');
    }
}