<?php

namespace Core\Models\Repositories;

class BaseRepository
{
    /**
     * stores a model
     *
     * @param object $aModel - model instance
     * @return int
     */
    public static function save($aModel) {
        return $aModel->save();
    }
}