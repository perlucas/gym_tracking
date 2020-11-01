<?php

namespace Core\Controllers;
use Core\Models\Repositories\TraineeRepository;
use Core\Models\Repositories\AttendanceRepository;
use Core\Services\AttendanceService;
use Core\Utils\FlashMessages;
use Core\Exporters\ExcelAttendanceExporter as AttendanceExporter;

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
        $result = $service->registerAttendance((int) $trainee_id, new \DateTime());

        if ($result->isSuccess()) {
            $trainee = TraineeRepository::findOneById($trainee_id);
            
            FlashMessages::getInstance()
                ->success("Se ha registrado el ingreso de {$trainee->getFullname()} con éxito");
        } else {
            FlashMessages::getInstance()
                ->error($result->getErrorMessage());
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
                'export/export.js',
                'datepickers.js'
            )
        );

        $this->app->render( $this->layouts['web'] );
    }

    /**
     * handles the POST /attendance/export request
     *
     * @return void
     */
    public function exportAttendances() {
        $startDate = $this->app->request()->data->start_date;
        $endDate = $this->app->request()->data->end_date;

        $attendances = [];
        
        if ($startDate && $endDate) {
            $attendances = AttendanceRepository::findAttendancesBetween($startDate, $endDate);
        }
        else if ($startDate) {
            $attendances = AttendanceRepository::findAttendancesFrom($startDate);
        }
        else if ($endDate) {
            $attendances = AttendanceRepository::findAttendancesTo($endDate);
        }
        else {
            $attendances = AttendanceRepository::findAllAttendances();
        }

        $exporter = new AttendanceExporter();
        $file = $exporter->exportAttendances($attendances);

        if (file_exists($file)) {
            $this->downloadFile($file);
        }
    }
}