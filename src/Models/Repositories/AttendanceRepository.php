<?php

namespace Core\Models\Repositories;
use Core\Models\AttendanceQuery;

class AttendanceRepository extends BaseRepository
{
    /**
     * finds the last attendace for this trainee id
     *
     * @param string|int $traineeId
     * @return Core\Models\Attendace|null
     */
    public static function findLastAttendanceFor($traineeId) {
        return AttendanceQuery::create()
            ->filterByTraineeId($traineeId)
            ->mostRecent()
            ->findOne();
    }
}