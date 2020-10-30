<?php

namespace Core\Services;
use \Core\Models\TraineeQuery;
use Propel\Runtime\Collection\ObjectCollection;

class TraineeService
{
    /**
     * searches trainees using the value as dni or fullname
     *
     * @param string $term
     * @return 
     */
    public function fetchByFullNameOrDNI($term) {
        if ($term) {
            return TraineeQuery::create()
                ->filterByFullNameOrDNI($term)
                ->limit(7)
                ->find();
        }
        return ObjectCollection::fromArray([]);
    }
}