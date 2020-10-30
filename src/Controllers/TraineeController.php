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

    /**
     * retrieves trainees indexed by id as json
     *
     * @return void
     */
    public function fetchTrainees() {
        $data = array(
            array('id' => 1, 'fullname' => 'Santiago Rivero', 'dni' => '39088088'),
            array('id' => 2, 'fullname' => 'Nico Doncheff', 'dni' => '39066088'),
            array('id' => 3, 'fullname' => 'Lionel Messi', 'dni' => '39044555'),
            array('id' => 4, 'fullname' => 'Martin Palermo', 'dni' => '34455666'),
            array('id' => 5, 'fullname' => 'Juan Riquelme', 'dni' => '39044888'),
            array('id' => 5, 'fullname' => $this->app->request()->query->term, 'dni' => '39044888'),
        );

        $this->app->json($data);
    }
}