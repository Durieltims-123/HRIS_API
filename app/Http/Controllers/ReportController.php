<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use ZipArchive;


class ReportController extends Controller
{
    public function generateInitialComparativeAssessementFormPerMeeting(Interview $interview)
    {
        $zipFileName = 'PSB ' . $interview->meeting_date . '.zip';
        $zipFilePath = public_path("/zips/" . $zipFileName); // Save to public directory

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

                $permanents = $vacancy->hasManyApplications->where('application_type', 'Insider-Permanent')->whereIn('status', ['Shortlisted', 'Interviewed']);
                $casuals = $vacancy->hasManyApplications->where('application_type', 'Insider-Casual')->whereIn('status', ['Shortlisted', 'Interviewed']);
                $outsiders = $vacancy->hasManyApplications->where('application_type', 'Outsider')->whereIn('status', ['Shortlisted', 'Interviewed']);


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


                    // Duplicate  rows if count of applicants is greater than 1
                    if (count($permanents) > 1) {
                        // Define the range of rows to copy (e.g., rows 1 to 10)
                        $startRow = 10;
                        $endRow = 14;

                        // Define how many times to duplicate the rows
                        $duplicateCount = count($permanents) - 1;

                        // Calculate the number of rows to duplicate
                        $rowsToDuplicate = $endRow - $startRow + 1;

                        // Calculate the total number of rows to insert
                        $totalRowsToInsert = $rowsToDuplicate * $duplicateCount;

                        // Insert the required number of rows at the end of the range
                        $insertPosition = $endRow + 1;
                        $worksheet->insertNewRowBefore($insertPosition, $totalRowsToInsert);

                        // Get the merged cell ranges
                        $mergedCells = $worksheet->getMergeCells();
                        sort($mergedCells);
                        $mg = [];

                        // Iterate over the range to duplicate the rows multiple times


                        for ($i = 0; $i < $duplicateCount; $i++) {
                            for ($row = $startRow; $row <= $endRow; $row++) {
                                // Read the row
                                $rowData = $worksheet->rangeToArray("A$row:" . $worksheet->getHighestColumn() . $row, NULL, TRUE, TRUE, TRUE);

                                // Determine the target row for duplication
                                $targetRow = $insertPosition + $i * $rowsToDuplicate + ($row - $startRow);

                                // Write the row data to the new target row
                                $worksheet->fromArray($rowData[$row], NULL, "A$targetRow");


                             
                            }

                            // Copy merged cells
                            // foreach ($mergedCells as $mergedCell) {
                            //     $mergedRange = explode(':', $mergedCell);
                            //     $startCell = $mergedRange[0];
                            //     $endCell = $mergedRange[1];

                            //     preg_match('/([A-Z]+)(\d+)/', $startCell, $startCellParts);
                            //     preg_match('/([A-Z]+)(\d+)/', $endCell, $endCellParts);


                            //     $startColumn = $startCellParts[1];
                            //     $startRowNumber = $startCellParts[2];
                            //     $endColumn = $endCellParts[1];
                            //     $endRowNumber = $endCellParts[2];


                            //     if ($startRowNumber >= $startRow && $endRowNumber <= $endRow) {
                            //         // array_push($mg, [$startRowNumber, $startRow, $endRowNumber, $endRow]);
                            //         $newStartRow = $targetRow + ($startRowNumber - $startRow);
                            //         $newEndRow = $targetRow + ($endRowNumber - $startRow);
                            //         $newMergedRange = $startColumn . $newStartRow . ':' . $endColumn . $newEndRow;
                            //         if (!in_array($newMergedRange, $mg)) {
                            //             array_push($mg, $newMergedRange);
                            //         }
                            //         //     $worksheet->mergeCells($newMergedRange);
                            //     }
                            // }
                        }
                    }
                } else {
                    $activeSheetIndex = $spreadsheet->getActiveSheetIndex();
                    $spreadsheet->removeSheetByIndex($activeSheetIndex);
                }
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save(public_path("/Excel Results/" . $position->title . "-" . $lgu_position->item_number . ".xlsx"));

                return compact('mg');

                $zip->addFile(public_path("/Excel Results/" . $position->title . "-" . $lgu_position->item_number . ".xlsx"));
            }

            $zip->close();
        }



        return "SUCCESSFUL";
    }
}
