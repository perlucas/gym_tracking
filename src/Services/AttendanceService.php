<?php

namespace Core\Services;

class AttendanceService
{
    /**
     * registers the new attendance for the trainee
     *
     * @param integer $traineeId
     * @param \DateTime $dateTime
     * @return OperationResult
     */
    public function registerAttendance(
        int $traineeId,
        \DateTime $dateTime
    ): OperationResult {
        
        // check that at least 1 hour has passed from last attendance

        // create and store new attendance at specified datetime

        if (! $traineeId) {
            return OperationResult::createFail(OperationErrors::INVALID_TRAINEE_ID);
        }

        return OperationResult::createSuccess();
    }
}