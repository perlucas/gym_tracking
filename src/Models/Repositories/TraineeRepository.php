<?php

namespace Core\Models\Repositories;
use Core\Models\TraineeQuery;

class TraineeRepository extends BaseRepository
{
    const LIMIT_ON_AUTOCOMPLETE = 7;

    /**
     * finds trainees using the term value as dni or fullname
     *
     * @param string $term
     * @return array
     */
    public static function findByFullNameOrDNI($term) {
        if ($term) {
            return TraineeQuery::create()
                ->filterByFullNameOrDNI($term)
                ->limit(static::LIMIT_ON_AUTOCOMPLETE)
                ->find()
                ->getArrayCopy();
        }
        return [];
    }

    /**
     * finds a trainee by its id
     *
     * @param string|int $id
     * @return Core\Models\Trainee
     */
    public static function findOneById($id) {
        return TraineeQuery::create()->findOneById($id);
    }
    
    /**
     * finds a trainee by its dni
     *
     * @param string $dni
     * @return Core\Models\Trainee
     */
    public static function findOneByDni($dni) {
        return TraineeQuery::create()->findOneByDni($dni);
    }

    /**
     * finds all the trainees
     *
     * @return array
     */
    public static function findAll() {
        return TraineeQuery::create()->find()->getArrayCopy();
    }
}