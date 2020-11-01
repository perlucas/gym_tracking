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

    /**
     * finds all attendances from database
     *
     * @param boolean $withTrainees
     * @return array
     */
    public static function findAllAttendances($withTrainees = true) {
        $query = AttendanceQuery::create();
        if ($withTrainees) {
            $query->joinWith('Attendance.Trainee');
        }
        return $query->mostRecent()->find()->getArrayCopy();
    }
    
    /**
     * finds all attendances from the starting date
     *
     * @param string $date - format YYY-mm-dd
     * @param boolean $withTrainees
     * @return array
     */
    public static function findAttendancesFrom($date, $withTrainees = true) {
        $query = AttendanceQuery::create()->where('DATE(Attendance.timestamp) >= ?', $date);
        if ($withTrainees) {
            $query->joinWith('Attendance.Trainee');
        }
        return $query->mostRecent()->find()->getArrayCopy();
    }

    /**
     * finds all the attendances to the end date
     *
     * @param string $date - format YYY-mm-dd
     * @param boolean $withTrainees
     * @return array
     */
    public static function findAttendancesTo($date, $withTrainees = true) {
        $query = AttendanceQuery::create()->where('DATE(Attendance.timestamp) <= ?', $date);
        if ($withTrainees) {
            $query->joinWith('Attendance.Trainee');
        }
        return $query->mostRecent()->find()->getArrayCopy();
    }

    /**
     * finds all the attendances between the provided dates
     *
     * @param string $start - format YYY-mm-dd
     * @param string $end - format YYY-mm-dd
     * @param boolean $withTrainees
     * @return array
     */
    public static function findAttendancesBetween($start, $end, $withTrainees = true) {
        $query = AttendanceQuery::create()
            ->where('DATE(Attendance.timestamp) >= ?', $start)
            ->where('DATE(Attendance.timestamp) <= ?', $end);
        if ($withTrainees) {
            $query->joinWith('Attendance.Trainee');
        }
        return $query->mostRecent()->find()->getArrayCopy();
    }
}