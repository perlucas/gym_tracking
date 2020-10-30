<?php

namespace Core\Controllers;
use Core\Services\AttendanceService;
use Core\Utils\FlashMessages;

class AttendanceController extends BaseController
{
    /**
     * creates a new attendance record for the trainee
     *
     * @param int $trainee_id
     * @return void
     */
    public function createForTrainee($trainee_id = null) {
        
        if ($trainee_id === null) {
            $trainee_id = $this->app->request()->data->trainee_id;        
        }

        $service = new AttendanceService();
        $result = $service->registerAttendance(
            (int) $trainee_id,
            new \DateTime()
        );

        if ($result->isSuccess()) {
            FlashMessages::getInstance()->success("Se ha registrado el ingreso de {$trainee_id} con éxito");
        } else {
            FlashMessages::getInstance()->error($result->getErrorMessage());
        }

        $this->app->redirect('/home');
    }

    /**
     * renders the /attendance/export page
     *
     * @return void
     */
    public function exportForm() {
        $this->app->render('attendance/export', array(), 'bodyContent');

        $this->app->view()->set('bodyScripts', 
            array(
                'export/export.js'
            )
        );

        $this->app->render( $this->layouts['web'] );
    }
}