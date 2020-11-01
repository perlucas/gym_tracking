<?php

namespace Core\Exporters;

abstract class TraineeExporter
{
    /**
     * exports trainees into a file and returns the path to the file
     *
     * @param array $trainees - array of Trainee model instances
     * @return string - path of the generated file
     */
    public abstract function exportTrainees(array $trainees): string;
}