<?php

namespace Core\Models;
use Core\Models\Base\AttendanceQuery as BaseAttendanceQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Skeleton subclass for performing query and update operations on the 'attendance' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class AttendanceQuery extends BaseAttendanceQuery
{
    /**
     * adds order by clause based on time of creation
     *
     * @return \ModelCriteria
     */
    public function mostRecent() {
        return $this->orderByTimestamp(Criteria::DESC);
    }
}
