<?php

namespace Core\Services;

use Core\Models\Attendance;
use Core\Models\Repositories\AttendanceRepository;

class AttendanceService
{
    /**
     * registers the new attendance for the trainee
     *
     * @param integer $traineeId
     * @param \DateTime $registerTime
     * @return OperationResult
     */
    public function registerAttendance(int $traineeId, \DateTime $registerTime): OperationResult {
        if (! $traineeId) {
            return OperationResult::createFail(OperationErrors::INVALID_TRAINEE_ID);
        }
        
        $lastAttendance = AttendanceRepository::findLastAttendanceFor($traineeId);
        
        if ($lastAttendance) {
            $diff = $registerTime->diff($lastAttendance->getTimestamp());
            if ($diff->h < 1) {
                return OperationResult::createFail(OperationErrors::LAST_ATTENDANCE_WAS_RECENT);
            }
        }

        $attendance = new Attendance();
        $attendance->setTraineeId($traineeId);
        $attendance->setTimestamp($registerTime);
        AttendanceRepository::save($attendance);

        return OperationResult::createSuccess();
    }
}