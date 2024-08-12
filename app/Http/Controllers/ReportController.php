<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Illuminate\Support\Facades\Storage;
use App\Traits\HttpResponses;

use ZipArchive;


class ReportController extends Controller
{

    use HttpResponses;

    public function generateInitialComparativeAssessementFormPerMeeting(Interview $interview)
    {
        $files=[];
        $filename = 'PSB ' . $interview->meeting_date . '.zip';
        $zipFilePath = public_path("/zips/" . $filename); // Save to public directory

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {

            $templatePath = public_path('/Excel Templates/CAF.xlsx');

            foreach ($interview->vacancyInterview as $vacancyInterview) {
                $spreadsheet = IOFactory::load($templatePath);

                $vacancy = $vacancyInterview->vacancy;
                $lgu_position = $vacancyInterview->vacancy->lguPosition;
                $position = $lgu_position->position;
                $qualification_standard = $position->qualificationStandards;
                $division = $lgu_position->division;
                $office = $division->office;

                $permanents = $vacancy->hasManyApplications->where('application_type', 'Insider-Permanent')->whereIn('status', ['Shortlisted', 'Interviewed'])->sortBy('last_name');
                $casuals = $vacancy->hasManyApplications->where('application_type', 'Insider-Casual')->whereIn('status', ['Shortlisted', 'Interviewed'])->sortBy('last_name');
                $outsiders = $vacancy->hasManyApplications->where('application_type', 'Outsider')->whereIn('status', ['Shortlisted', 'Interviewed'])->sortBy('last_name');


                //  Fill Permanent Applicants
                $worksheet = $spreadsheet->setActiveSheetIndexByName("Permanent");

                if (count($permanents) > 0) {
                    // fill position details
                    $worksheet->setCellValue("G3", $position->title . " - " . $lgu_position->item_number);
                    $worksheet->setCellValue("M3", $position->salaryGrade->amount);
                    $worksheet->setCellValue("M4", $position->salaryGrade->number);
                    $worksheet->setCellValue("O3", $office->office_name);
                    $worksheet->setCellValue("O4", $division->division_name);
                    $worksheet->setCellValue("F6", $qualification_standard->education);
                    $worksheet->setCellValue("M6", $qualification_standard->training);
                    $worksheet->setCellValue("F7", $qualification_standard->experience);
                    $worksheet->setCellValue("M7", $qualification_standard->eligibility);
                    $worksheet->setCellValue("A18", "standards of the position of $position->title.");


                    // Define the range of rows to copy (e.g., rows 1 to 10)
                    $startRow = 10;
                    $endRow = 14;

                    // Define how many times to duplicate the rows
                    $duplicateCount = count($permanents) - 1;


                    // Calculate the number of rows to duplicate
                    $rowsToDuplicate = $endRow - $startRow + 1;

                    // Duplicate  rows if count of applicants is greater than 1
                    if (count($permanents) > 1) {

                        // Calculate the total number of rows to insert
                        $totalRowsToInsert = $rowsToDuplicate * $duplicateCount;

                        // Insert the required number of rows at the end of the range
                        $insertPosition = $endRow + 1;
                        $worksheet->insertNewRowBefore($insertPosition, $totalRowsToInsert);

                        // Get the merged cell ranges
                        $mergedCells = $worksheet->getMergeCells();


                        //filter merged cell on specific selected rows
                        $mergedCells = array_filter($mergedCells, function ($mergedCell) use ($startRow, $endRow) {
                            $mergedRange = explode(':', $mergedCell);
                            $startCell = $mergedRange[0];
                            $endCell = $mergedRange[1];
                            preg_match('/([A-Z]+)(\d+)/', $startCell, $startCellParts);
                            preg_match('/([A-Z]+)(\d+)/', $endCell, $endCellParts);
                            $startRowNumber = $startCellParts[2];
                            $endRowNumber = $endCellParts[2];

                            if ($startRowNumber >= $startRow && $endRowNumber <= $endRow) {
                                return $mergedCell;
                            }
                        });
                        sort($mergedCells);

                        // Iterate over the range to duplicate the rows multiple times
                        for ($i = 0; $i < $duplicateCount; $i++) {

                            // duplicate multiple rows
                            for ($row = $startRow; $row <= $endRow; $row++) {
                                // Read the row
                                $rowData = $worksheet->rangeToArray("A$row:" . $worksheet->getHighestColumn() . $row, NULL, TRUE, TRUE, TRUE);

                                // Determine the target row for duplication
                                $targetRow = $insertPosition + $i * $rowsToDuplicate + ($row - $startRow);

                                // Write the row data to the new target row
                                $worksheet->fromArray($rowData[$row], NULL, "A$targetRow");



                                // copy merged cells to duplicated rows
                                foreach ($mergedCells as $mergedCell) {
                                    $mergedRange = explode(':', $mergedCell);
                                    $startCell = $mergedRange[0];
                                    $endCell = $mergedRange[1];

                                    preg_match('/([A-Z]+)(\d+)/', $startCell, $startCellParts);
                                    preg_match('/([A-Z]+)(\d+)/', $endCell, $endCellParts);

                                    $startColumn = $startCellParts[1];
                                    $startRowNumber = $startCellParts[2];
                                    $endColumn = $endCellParts[1];
                                    $endRowNumber = $endCellParts[2];


                                    if ($targetRow - (($i + 1) * $rowsToDuplicate) == $startRowNumber && $targetRow - (($i + 1) * $rowsToDuplicate) <= $endRowNumber) {
                                        if ($startRowNumber < $endRowNumber) {
                                            $newMergedRange = $startColumn . $targetRow . ':' . $endColumn . $targetRow + ($endRowNumber - $startRowNumber);
                                        } else {
                                            $newMergedRange = $startColumn . $targetRow . ':' . $endColumn . $targetRow;
                                        }

                                        $worksheet->mergeCells($newMergedRange);
                                        $styleArray = (object) $worksheet->getStyle($mergedCell)->exportArray();

                                        // Apply the styles to the target range
                                        $worksheet->getStyle($newMergedRange)->applyFromArray([
                                            'alignment' => $styleArray->alignment,
                                            'fill' => $styleArray->fill,
                                            'font' => $styleArray->font,
                                            'numberFormat' => $styleArray->numberFormat,
                                        ]);
                                    }

                                    $worksheet->setCellValue("G3", $position->title . " - " . $lgu_position->item_number);
                                }
                            }
                        }
                    }
                    // Insert Application Details
                    $counter = 0;
                    foreach ($permanents as $index => $permanent) {
                        $row = $startRow + ($counter * $rowsToDuplicate);
                        $worksheet->setCellValue("A" . $row, ($counter + 1));

                        $personalInformation = $permanent->individual->latestPersonalDataSheet->personalInformation;

                        $address = $personalInformation->permanent_barangay . "," . ucwords(strtolower($personalInformation->permanent_municipality)) . "," . ucwords(strtolower($personalInformation->permanent_province));
                        $age_civil_status = $personalInformation->age . "/" . $personalInformation->civil_status;

                        // Employee Details
                        $middle_initial = ($permanent->middle_name != '') ? " " . $permanent->middle_name[0] . ". " : " ";
                        $worksheet->setCellValue("C" . $row, strtoupper(strtolower($permanent->first_name . $middle_initial . $permanent->last_name)));
                        $worksheet->setCellValue("F" . $row + 1, $permanent->individual->lguPosition->position->title);
                        $worksheet->setCellValue("F" . $row + 2, $address);
                        $worksheet->setCellValue("F" . $row + 3, $age_civil_status);
                        $worksheet->setCellValue("I" . $row, $permanent->assessment->appropriate_eligibility);
                        $worksheet->getStyle("I" . $row)->getAlignment()->setWrapText(true);
                        $worksheet->getStyle("F" . $row . ":F" . $row + 3)->getAlignment()->setWrapText(true);

                        // assessment
                        $worksheet->setCellValue("J" . $row, $permanent->assessment->training);
                        $worksheet->setCellValue("K" . $row, $permanent->assessment->performance);
                        $worksheet->setCellValue("L" . $row, $permanent->assessment->education);
                        $worksheet->setCellValue("M" . $row, $permanent->assessment->experience);
                        $worksheet->setCellValue("R" . $row, '=SUM(K' . $row . ':Q' . $row . ')');
                        $counter++;
                    }
                } else {
                    $activeSheetIndex = $spreadsheet->getActiveSheetIndex();
                    $spreadsheet->removeSheetByIndex($activeSheetIndex);
                }

                //  Fill Casual Applicants
                $worksheet = $spreadsheet->setActiveSheetIndexByName("Casual");

                if (count($casuals) > 0) {
                    // fill position details
                    $worksheet->setCellValue("G3", $position->title . " - " . $lgu_position->item_number);
                    $worksheet->setCellValue("M3", $position->salaryGrade->amount);
                    $worksheet->setCellValue("M4", $position->salaryGrade->number);
                    $worksheet->setCellValue("O3", $office->office_name);
                    $worksheet->setCellValue("O4", $division->division_name);
                    $worksheet->setCellValue("F6", $qualification_standard->education);
                    $worksheet->setCellValue("M6", $qualification_standard->training);
                    $worksheet->setCellValue("F7", $qualification_standard->experience);
                    $worksheet->setCellValue("M7", $qualification_standard->eligibility);
                    $worksheet->setCellValue("A18", "standards of the position of $position->title.");

                    // Define the range of rows to copy (e.g., rows 1 to 10)
                    $startRow = 10;
                    $endRow = 14;

                    // Define how many times to duplicate the rows
                    $duplicateCount = count($casuals) - 1;

                    // Calculate the number of rows to duplicate
                    $rowsToDuplicate = $endRow - $startRow + 1;

                    if (count($casuals) > 1) {

                        // Calculate the total number of rows to insert
                        $totalRowsToInsert = $rowsToDuplicate * $duplicateCount;

                        // Insert the required number of rows at the end of the range
                        $insertPosition = $endRow + 1;
                        $worksheet->insertNewRowBefore($insertPosition, $totalRowsToInsert);

                        // Get the merged cell ranges
                        $mergedCells = $worksheet->getMergeCells();


                        //filter merged cell on specific selected rows
                        $mergedCells = array_filter($mergedCells, function ($mergedCell) use ($startRow, $endRow) {
                            $mergedRange = explode(':', $mergedCell);
                            $startCell = $mergedRange[0];
                            $endCell = $mergedRange[1];
                            preg_match('/([A-Z]+)(\d+)/', $startCell, $startCellParts);
                            preg_match('/([A-Z]+)(\d+)/', $endCell, $endCellParts);
                            $startRowNumber = $startCellParts[2];
                            $endRowNumber = $endCellParts[2];

                            if ($startRowNumber >= $startRow && $endRowNumber <= $endRow) {
                                return $mergedCell;
                            }
                        });
                        sort($mergedCells);

                        // Iterate over the range to duplicate the rows multiple times
                        for ($i = 0; $i < $duplicateCount; $i++) {

                            // duplicate multiple rows
                            for ($row = $startRow; $row <= $endRow; $row++) {
                                // Read the row
                                $rowData = $worksheet->rangeToArray("A$row:" . $worksheet->getHighestColumn() . $row, NULL, TRUE, TRUE, TRUE);

                                // Determine the target row for duplication
                                $targetRow = $insertPosition + $i * $rowsToDuplicate + ($row - $startRow);

                                // Write the row data to the new target row
                                $worksheet->fromArray($rowData[$row], NULL, "A$targetRow");



                                // copy merged cells to duplicated rows
                                foreach ($mergedCells as $mergedCell) {
                                    $mergedRange = explode(':', $mergedCell);
                                    $startCell = $mergedRange[0];
                                    $endCell = $mergedRange[1];

                                    preg_match('/([A-Z]+)(\d+)/', $startCell, $startCellParts);
                                    preg_match('/([A-Z]+)(\d+)/', $endCell, $endCellParts);

                                    $startColumn = $startCellParts[1];
                                    $startRowNumber = $startCellParts[2];
                                    $endColumn = $endCellParts[1];
                                    $endRowNumber = $endCellParts[2];


                                    if ($targetRow - (($i + 1) * $rowsToDuplicate) == $startRowNumber && $targetRow - (($i + 1) * $rowsToDuplicate) <= $endRowNumber) {
                                        if ($startRowNumber < $endRowNumber) {
                                            $newMergedRange = $startColumn . $targetRow . ':' . $endColumn . $targetRow + ($endRowNumber - $startRowNumber);
                                        } else {
                                            $newMergedRange = $startColumn . $targetRow . ':' . $endColumn . $targetRow;
                                        }

                                        $worksheet->mergeCells($newMergedRange);
                                        $styleArray = (object) $worksheet->getStyle($mergedCell)->exportArray();

                                        // Apply the styles to the target range
                                        $worksheet->getStyle($newMergedRange)->applyFromArray([
                                            'alignment' => $styleArray->alignment,
                                            'fill' => $styleArray->fill,
                                            'font' => $styleArray->font,
                                            'numberFormat' => $styleArray->numberFormat,
                                        ]);
                                    }

                                    $worksheet->setCellValue("G3", $position->title . " - " . $lgu_position->item_number);
                                }
                            }
                        }
                    }

                    // Insert Application Details
                    $counter = 0;
                    foreach ($casuals as $index => $casual) {
                        $row = $startRow + ($counter * $rowsToDuplicate);
                        $worksheet->setCellValue("A" . $row, ($counter + 1));

                        $personalInformation = $casual->individual->latestPersonalDataSheet->personalInformation;

                        $address = $personalInformation->casual_barangay . "," . ucwords(strtolower($personalInformation->casual_municipality)) . "," . ucwords(strtolower($personalInformation->casual_province));
                        $age_civil_status = $personalInformation->age . "/" . $personalInformation->civil_status;

                        // Employee Details
                        $middle_initial = ($casual->middle_name != '') ? " " . $casual->middle_name[0] . ". " : " ";
                        $worksheet->setCellValue("C" . $row, strtoupper(strtolower($casual->first_name . $middle_initial . $casual->last_name)));
                        $worksheet->setCellValue("F" . $row + 1, $casual->individual->lguPosition->position->title);
                        $worksheet->setCellValue("F" . $row + 2, $address);
                        $worksheet->setCellValue("F" . $row + 3, $age_civil_status);
                        $worksheet->setCellValue("I" . $row, $casual->assessment->appropriate_eligibility);
                        $worksheet->getStyle("I" . $row)->getAlignment()->setWrapText(true);
                        $worksheet->getStyle("F" . $row . ":F" . $row + 3)->getAlignment()->setWrapText(true);

                        // assessment
                        $worksheet->setCellValue("J" . $row, $casual->assessment->training);
                        $worksheet->setCellValue("K" . $row, $casual->assessment->performance);
                        $worksheet->setCellValue("L" . $row, $casual->assessment->education);
                        $worksheet->setCellValue("M" . $row, $casual->assessment->experience);
                        $worksheet->setCellValue("R" . $row, '=SUM(K' . $row . ':Q' . $row . ')');
                        $counter++;
                    }
                } else {
                    $activeSheetIndex = $spreadsheet->getActiveSheetIndex();
                    $spreadsheet->removeSheetByIndex($activeSheetIndex);
                }

                //  Fill Outsider Applicants
                $worksheet = $spreadsheet->setActiveSheetIndexByName("Outsider");

                if (count($outsiders) > 0) {
                    // fill position details
                    $worksheet->setCellValue("G3", $position->title . " - " . $lgu_position->item_number);
                    $worksheet->setCellValue("M3", $position->salaryGrade->amount);
                    $worksheet->setCellValue("M4", $position->salaryGrade->number);
                    $worksheet->setCellValue("O3", $office->office_name);
                    $worksheet->setCellValue("O4", $division->division_name);
                    $worksheet->setCellValue("F6", $qualification_standard->education);
                    $worksheet->setCellValue("M6", $qualification_standard->training);
                    $worksheet->setCellValue("F7", $qualification_standard->experience);
                    $worksheet->setCellValue("M7", $qualification_standard->eligibility);
                    $worksheet->setCellValue("A18", "standards of the position of $position->title.");


                    // Define the range of rows to copy (e.g., rows 1 to 10)
                    $startRow = 10;
                    $endRow = 14;

                    // Define how many times to duplicate the rows
                    $duplicateCount = count($outsiders) - 1;

                    // Calculate the number of rows to duplicate
                    $rowsToDuplicate = $endRow - $startRow + 1;

                    // Duplicate  rows if count of applicants is greater than 1
                    if (count($outsiders) > 1) {

                        // Calculate the total number of rows to insert
                        $totalRowsToInsert = $rowsToDuplicate * $duplicateCount;

                        // Insert the required number of rows at the end of the range
                        $insertPosition = $endRow + 1;
                        $worksheet->insertNewRowBefore($insertPosition, $totalRowsToInsert);

                        // Get the merged cell ranges
                        $mergedCells = $worksheet->getMergeCells();


                        //filter merged cell on specific selected rows
                        $mergedCells = array_filter($mergedCells, function ($mergedCell) use ($startRow, $endRow) {
                            $mergedRange = explode(':', $mergedCell);
                            $startCell = $mergedRange[0];
                            $endCell = $mergedRange[1];
                            preg_match('/([A-Z]+)(\d+)/', $startCell, $startCellParts);
                            preg_match('/([A-Z]+)(\d+)/', $endCell, $endCellParts);
                            $startRowNumber = $startCellParts[2];
                            $endRowNumber = $endCellParts[2];

                            if ($startRowNumber >= $startRow && $endRowNumber <= $endRow) {
                                return $mergedCell;
                            }
                        });
                        sort($mergedCells);

                        // Iterate over the range to duplicate the rows multiple times
                        for ($i = 0; $i < $duplicateCount; $i++) {

                            // duplicate multiple rows
                            for ($row = $startRow; $row <= $endRow; $row++) {
                                // Read the row
                                $rowData = $worksheet->rangeToArray("A$row:" . $worksheet->getHighestColumn() . $row, NULL, TRUE, TRUE, TRUE);

                                // Determine the target row for duplication
                                $targetRow = $insertPosition + $i * $rowsToDuplicate + ($row - $startRow);

                                // Write the row data to the new target row
                                $worksheet->fromArray($rowData[$row], NULL, "A$targetRow");



                                // copy merged cells to duplicated rows
                                foreach ($mergedCells as $mergedCell) {
                                    $mergedRange = explode(':', $mergedCell);
                                    $startCell = $mergedRange[0];
                                    $endCell = $mergedRange[1];

                                    preg_match('/([A-Z]+)(\d+)/', $startCell, $startCellParts);
                                    preg_match('/([A-Z]+)(\d+)/', $endCell, $endCellParts);

                                    $startColumn = $startCellParts[1];
                                    $startRowNumber = $startCellParts[2];
                                    $endColumn = $endCellParts[1];
                                    $endRowNumber = $endCellParts[2];


                                    if ($targetRow - (($i + 1) * $rowsToDuplicate) == $startRowNumber && $targetRow - (($i + 1) * $rowsToDuplicate) <= $endRowNumber) {
                                        if ($startRowNumber < $endRowNumber) {
                                            $newMergedRange = $startColumn . $targetRow . ':' . $endColumn . $targetRow + ($endRowNumber - $startRowNumber);
                                        } else {
                                            $newMergedRange = $startColumn . $targetRow . ':' . $endColumn . $targetRow;
                                        }

                                        $worksheet->mergeCells($newMergedRange);
                                        $styleArray = (object) $worksheet->getStyle($mergedCell)->exportArray();

                                        // Apply the styles to the target range
                                        $worksheet->getStyle($newMergedRange)->applyFromArray([
                                            'alignment' => $styleArray->alignment,
                                            'fill' => $styleArray->fill,
                                            'font' => $styleArray->font,
                                            'numberFormat' => $styleArray->numberFormat,
                                        ]);
                                    }

                                    $worksheet->setCellValue("G3", $position->title . " - " . $lgu_position->item_number);
                                }
                            }
                        }
                    }
                    // Insert Application Details
                    $counter = 0;
                    foreach ($outsiders as $index => $outsider) {
                        $row = $startRow + ($counter * $rowsToDuplicate);
                        $worksheet->setCellValue("A" . $row, ($counter + 1));
                        $work = $outsider->individual->latestPersonalDataSheet->workExperiences->whereNull('date_to')->sortBy('date_from');
                        $personalInformation = $outsider->individual->latestPersonalDataSheet->personalInformation;
                        $address = $personalInformation->outsider_barangay . "," . ucwords(strtolower($personalInformation->outsider_municipality)) . "," . ucwords(strtolower($personalInformation->outsider_province));
                        $age_civil_status = $personalInformation->age . "/" . $personalInformation->civil_status;

                        // Employee Details
                        $middle_initial = ($outsider->middle_name != '') ? " " . $outsider->middle_name[0] . ". " : " ";
                        $worksheet->setCellValue("C" . $row, strtoupper(strtolower($outsider->first_name . $middle_initial . $outsider->last_name)));

                        if (count($work) > 0) {
                            $worksheet->setCellValue("F" . $row + 1, $work[0]->position_title . "(" . $work[0]->status_of_appointment . ")" . $work[0]->office_company);
                        }

                        $worksheet->setCellValue("F" . $row + 2, $address);
                        $worksheet->setCellValue("F" . $row + 3, $age_civil_status);
                        $worksheet->setCellValue("I" . $row, $outsider->assessment->appropriate_eligibility);
                        $worksheet->getStyle("I" . $row)->getAlignment()->setWrapText(true);
                        $worksheet->getStyle("F" . $row . ":F" . $row + 3)->getAlignment()->setWrapText(true);

                        // assessment
                        $worksheet->setCellValue("J" . $row, $outsider->assessment->training);
                        $worksheet->setCellValue("K" . $row, $outsider->assessment->performance);
                        $worksheet->setCellValue("L" . $row, $outsider->assessment->education);
                        $worksheet->setCellValue("M" . $row, $outsider->assessment->experience);
                        $worksheet->setCellValue("R" . $row, '=SUM(K' . $row . ':Q' . $row . ')');
                        $counter++;
                    }
                } else {
                    $activeSheetIndex = $spreadsheet->getActiveSheetIndex();
                    $spreadsheet->removeSheetByIndex($activeSheetIndex);
                }

                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $path = public_path("/Excel Results/" . $position->title . "-" . $lgu_position->item_number . ".xlsx");
                $writer->save($path);

                $zip->addFile($path, basename($path));
            }
            $zip->close();
        }

        foreach($files as $file){
            if (File::exists($file)) {
                File::delete($file);
            }
        }

        $fileContents = file_get_contents($zipFilePath);
        $base64 = base64_encode($fileContents);

        if (File::exists($zipFilePath)) {
            File::delete($zipFilePath);
        }
        return $this->success(compact('base64', 'filename'), 'Successfully Retrieved.', 200);
    }
}
