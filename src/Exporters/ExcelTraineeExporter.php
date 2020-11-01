<?php

namespace Core\Exporters;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


class ExcelTraineeExporter extends TraineeExporter
{
    public function exportTrainees(array $trainees): string {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // headers
        $sheet->setCellValue('A1', 'Nombre y Apellido');
        $sheet->setCellValue('B1', 'DNI');
        $sheet->setCellValue('C1', 'Teléfono');
        $sheet->setCellValue('D1', 'Dirección');
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // rows
        $counter = 0;
        while ($counter < count($trainees)) {
            $excelRow = $counter + 2;
            $currentTrainee = $trainees[$counter];

            $sheet->getCell("A{$excelRow}")->setValueExplicit($currentTrainee->getFullName(), DataType::TYPE_STRING);
            $sheet->getCell("B{$excelRow}")->setValueExplicit($currentTrainee->getDni(), DataType::TYPE_STRING);
            $sheet->getCell("C{$excelRow}")->setValueExplicit($currentTrainee->getPhone(), DataType::TYPE_STRING);
            $sheet->getCell("D{$excelRow}")->setValueExplicit($currentTrainee->getAddress(), DataType::TYPE_STRING);

            $counter++;
        }
        
        foreach (['A', 'B', 'C', 'D'] as $columnLetter) {
            $sheet->getColumnDimension($columnLetter)->setAutoSize(true);
        }

        $filename = 'personas_' . ( new \DateTime() )->getTimestamp() . ".xlsx";
        $path = \pathJoin([ FILES_DIR, $filename] );
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return $path;
    }
}