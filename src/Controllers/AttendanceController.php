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
            FlashMessages::getInstance()->success('Se ha registrado el ingreso de %NOMBRE% con éxito');
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
    public function showExportOptions() {
        $this->app->render('attendance/export', array(), 'bodyContent');
        
        $this->app->view()->set('navLinks', 
            array(
                array('label' => 'Inicio', 'link' => '/home' ),
                array('label' => 'Administración', 'link' => '/admin' ),
                array('label' => 'Exportar personas', 'link' => '#' )
            )
        );

        $this->app->render('layout');
    }
}