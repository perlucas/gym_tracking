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

        $this->app->render('layout');
    }
}