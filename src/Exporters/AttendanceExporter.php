<?php

namespace Core\Exporters;

abstract class AttendanceExporter
{
    /**
     * exports attendances into a file and returns the path to the file
     *
     * @param array $attendances - array of Attendace model instances (with Trainee)
     * @return string - path of the generated file
     */
    public abstract function exportAttendances(array $attendances): string;
}