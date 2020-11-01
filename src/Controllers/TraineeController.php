<?php

namespace Core\Controllers;
use Core\Models\Repositories\TraineeRepository;
use Core\Models\Trainee;
use Core\Models\Validators\TraineeValidator;
use Core\Utils\FlashMessages;
use Core\Exporters\ExcelTraineeExporter as TraineeExporter;

class TraineeController extends BaseController
{
    /**
     * renders the /trainee/new page
     *
     * @return void
     */
    public function createForm($trainee = null) {
        $this->app->view()->set('trainee', $trainee);
        
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
     * handles the POST /trainee/export request
     *
     * @return void
     */
    public function exportTrainees() {
        \Core\Utils\FilesCleaner::scanAndCleanFiles();

        $trainees = TraineeRepository::findAll();
        $exporter = new TraineeExporter();
        $file = $exporter->exportTrainees($trainees);
        
        if (file_exists($file)) {
            $this->downloadFile($file);
        }
    }

    /**
     * fetchs trainees using the term query param
     *
     * @return void
     */
    public function fetchTrainees() {
        $term = $this->app->request()->query->term;

        $trainees = TraineeRepository::findByFullNameOrDNI($term);
        
        $result = array_map(
            function ($trainee) {
                return [
                    'id' => $trainee->getId(),
                    'fullname' => $trainee->getFullname(),
                    'dni' => $trainee->getDni()
                ];
            }, 
            $trainees
        );
        
        $this->app->json($result);
    }

    /**
     * stores a new trainee
     *
     * @return void
     */
    public function storeTrainee()
    {
        $traineeData = $this->app->request()->data;
        
        $trainee = new Trainee();
        $trainee->setFullName($traineeData['fullname']);
        $trainee->setDni($traineeData['dni']);
        $trainee->setPhone($traineeData['phone']);
        $trainee->setAddress($traineeData['address']);

        $violations = TraineeValidator::validate($trainee);
        
        if (count($violations)) {
            foreach ($violations as $violation) {
                FlashMessages::getInstance()->error($violation->getMessage());
            }
        }
        else {
            TraineeRepository::save($trainee);
            FlashMessages::getInstance()->success('La persona ha sido registrada con éxito');
            $traineeData = null;
        }

        $this->createForm($traineeData);
    }
}