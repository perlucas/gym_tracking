<?php

namespace Core\Services;

class OperationErrors
{
    const INVALID_TRAINEE_ID = 'invalid_trainee_id';
    const LAST_ATTENDANCE_WAS_RECENT = 'last_attendance_was_recent';

    /**
     * supported error codes with their messages
     *
     * @var array
     */
    private static $errors = null;

    /**
     * retrieves the error message
     *
     * @param int $code
     * @return string
     */
    public static function getErrorMessage($code) {
        if (! static::$errors) {
            static::initializeMessages();
        }
        return static::$errors[ $code ];
    }

    /**
     * initializes the error messages
     *
     * @return void
     */
    private static function initializeMessages() {
        static::$errors = [
            static::INVALID_TRAINEE_ID => 'El ID de la persona es inválido',
            static::LAST_ATTENDANCE_WAS_RECENT => 'Debe pasar al menos 1 hora entre registros de asistencia'
        ];
    }
}