<?php

namespace Core\Exporters;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


class ExcelAttendanceExporter extends AttendanceExporter
{
    public function exportAttendances(array $attendances): string {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // headers
        $sheet->setCellValue('A1', 'Fecha de Ingreso');
        $sheet->setCellValue('B1', 'Nombre y Apellido');
        $sheet->setCellValue('C1', 'DNI');
        $sheet->setCellValue('D1', 'Teléfono');
        $sheet->setCellValue('E1', 'Dirección');
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        // rows
        $counter = 0;
        while ($counter < count($attendances)) {
            $excelRow = $counter + 2;
            $currentAtt = $attendances[$counter];
            $currentTrainee = $currentAtt->getTrainee();

            $sheet->getCell("A{$excelRow}")->setValueExplicit(
                $currentAtt->getTimestamp()->format('d/m/Y H:i:s'),
                DataType::TYPE_STRING
            );
            $sheet->getCell("B{$excelRow}")->setValueExplicit($currentTrainee->getFullName(), DataType::TYPE_STRING);
            $sheet->getCell("C{$excelRow}")->setValueExplicit($currentTrainee->getDni(), DataType::TYPE_STRING);
            $sheet->getCell("D{$excelRow}")->setValueExplicit($currentTrainee->getPhone(), DataType::TYPE_STRING);
            $sheet->getCell("E{$excelRow}")->setValueExplicit($currentTrainee->getAddress(), DataType::TYPE_STRING);

            $counter++;
        }
        
        foreach (['A', 'B', 'C', 'D', 'E'] as $columnLetter) {
            $sheet->getColumnDimension($columnLetter)->setAutoSize(true);
        }

        $filename = 'asistencias_' . ( new \DateTime() )->getTimestamp() . ".xlsx";
        $path = \pathJoin([ FILES_DIR, $filename] );
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return $path;
    }
}