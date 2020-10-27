<?php

namespace Core\Controllers;

class TraineeController extends BaseController
{
    /**
     * renders the /trainee/new page
     *
     * @return void
     */
    public function createForm() {
        $this->app->render('trainee/create', array(), 'bodyContent');

        $this->app->render( $this->layouts['web'] );
    }

    /**
     * renders the /trainee/export page
     *
     * @return void
     */
    public function exportForm() {
        $this->app->render('trainee/export', array(), 'bodyContent');

        $this->app->view()->set('bodyScripts', 
            array(
                'export/export.js'
            )
        );

        $this->app->render( $this->layouts['web'] );
    }
}