<?php

namespace Core\Controllers;
use Core\Services\TraineeService;

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
        $term = $this->app->request()->query->term;
        $service = new TraineeService();
        $trainees = $service->fetchByFullNameOrDNI($term);
        $result = [];
        foreach ($trainees as $trainee) {
            $result[] = [
                'id' => $trainee->getId(),
                'fullname' => $trainee->getFullname(),
                'dni' => $trainee->getDni()
            ];
        }

        $this->app->json($result);
    }
}