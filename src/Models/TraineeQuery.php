<?php

namespace Core\Models;

use Core\Models\Base\TraineeQuery as BaseTraineeQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'trainee' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class TraineeQuery extends BaseTraineeQuery
{
    /**
     * custom filter added for filtering on dni and fullname
     *
     * @param string $term
     * @return \ModelCriteria
     */
    public function filterByFullNameOrDNI($term) {
        return $this
            ->where('Trainee.fullname LIKE ?', "%{$term}%")
            ->_or()
            ->where('Trainee.dni LIKE ?', "%{$term}%");
    }
}
