<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Employee;
use App\Models\Governor;
use App\Models\Interview;
use App\Models\LguPosition;
use App\Models\Office;
use App\Models\Vacancy;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Illuminate\Support\Facades\Storage;
use App\Traits\HttpResponses;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpWord\TemplateProcessor;
use ZipArchive;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReportController extends Controller
{

    use HttpResponses;

    public function generateInitialComparativeAssessementFormPerMeeting(Interview $interview)
    {
        $files = [];
        $filename = 'PSB ' . $interview->meeting_date . '.zip';
        $zipFilePath = public_path("/zips/" . $filename); // Save to public directory

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {

            $templatePath = public_path('/Excel Templates/CAF.xlsx');
            $templatePath2 = public_path('/Excel Templates/CAF-DH.xlsx');

            foreach ($interview->vacancyInterview as $vacancyInterview) {

                $vacancy = $vacancyInterview->vacancy;
                $lgu_position = $vacancyInterview->vacancy->lguPosition;
                $position = $lgu_position->position;
                $qualification_standard = $position->qualificationStandards;
                $division = $lgu_position->division;
                $office = $division->office;
                $head = false;

                // $spreadsheet = IOFactory::load($templatePath);
                if (strpos($position->code, "PGDH") === false) {
                    $spreadsheet = IOFactory::load($templatePath);
                    $head = false;
                } else {
                    $spreadsheet = IOFactory::load($templatePath2);
                    $head = true;
                }


                if ($head) {
                    $division_name = "";
                } else {
                    $division_name = $division->division_name;
                }



                $permanents = $vacancy->hasManyApplications->where('application_type', 'Insider-Permanent')->whereIn('status', ['Shortlisted', 'Interviewed'])->sortBy('last_name');
                $casuals = $vacancy->hasManyApplications->where('application_type', 'Insider-Casual')->whereIn('status', ['Shortlisted', 'Interviewed'])->sortBy('last_name');
                $outsiders = $vacancy->hasManyApplications->where('application_type', 'Outsider')->whereIn('status', ['Shortlisted', 'Interviewed'])->sortBy('last_name');


                //  Fill Permanent Applicants
                $worksheet = $spreadsheet->setActiveSheetIndexByName("Permanent");

                $richText = new Richtext();
                $richText->createText('standards of the position of ');

                // Add bold text
                $boldText = $richText->createTextRun($position->title);
                $boldText->getFont()->setBold(true);

                // Continue with normal text
                $richText->createText('.');



                if (count($permanents) > 0) {
                    // fill position details
                    $worksheet->setCellValue("G3", $position->title . " - " . $lgu_position->item_number);
                    $worksheet->setCellValue("M3", $position->salaryGrade->amount);
                    $worksheet->setCellValue("M4", $position->salaryGrade->number);
                    $worksheet->setCellValue("O3", $office->office_name);
                    $worksheet->setCellValue("O4", $division_name);
                    $worksheet->setCellValue("F6", $qualification_standard->education);
                    $worksheet->setCellValue("M6", $qualification_standard->training);
                    $worksheet->setCellValue("F7", $qualification_standard->experience);
                    $worksheet->setCellValue("M7", $qualification_standard->eligibility);
                    $worksheet->setCellValue("A20", $richText);


                    // Define the range of rows to copy (e.g., rows 1 to 10)
                    $startRow = 12;
                    $endRow = 16;

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
                        // $worksheet->setCellValue("S" . $row, '=SUM(K' . $row . ':R' . $row . ')');
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
                    $worksheet->setCellValue("O4", $division_name);
                    $worksheet->setCellValue("F6", $qualification_standard->education);
                    $worksheet->setCellValue("M6", $qualification_standard->training);
                    $worksheet->setCellValue("F7", $qualification_standard->experience);
                    $worksheet->setCellValue("M7", $qualification_standard->eligibility);
                    $worksheet->setCellValue("A20", $richText);

                    // Define the range of rows to copy (e.g., rows 1 to 10)
                    $startRow = 12;
                    $endRow = 16;

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
                        // $worksheet->setCellValue("S" . $row, '=SUM(K' . $row . ':R' . $row . ')');
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
                    $worksheet->setCellValue("O4", $division_name);
                    $worksheet->setCellValue("F6", $qualification_standard->education);
                    $worksheet->setCellValue("M6", $qualification_standard->training);
                    $worksheet->setCellValue("F7", $qualification_standard->experience);
                    $worksheet->setCellValue("M7", $qualification_standard->eligibility);
                    $worksheet->setCellValue("A20", $richText);


                    // Define the range of rows to copy (e.g., rows 1 to 10)
                    $startRow = 12;
                    $endRow = 16;

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
                        // $worksheet->setCellValue("S" . $row, '=SUM(K' . $row . ':R' . $row . ')');
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

        foreach ($files as $file) {
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

    public function generateNoticeOfMeeting(Interview $interview)
    {
        $filename =  "Notice of Meeting - $interview->meeting_date ";
        $filePath = public_path('\Word Results\\' . $filename . ".docx");

        $governor = Governor::latest()->first();
        $governor_name = $governor->prefix . " " . $governor->name . " " . $governor->suffix;



        // Group By Position Type and Per Office

        $positions = DB::table('vacancy_interviews')
            ->select('positions.title', 'salary_grades.number', 'offices.office_code', 'divisions.division_code', DB::raw('count(*) as count'))
            ->where('vacancy_interviews.interview_id', $interview->id)
            ->leftJoin('vacancies', 'vacancies.id', 'vacancy_interviews.vacancy_id')
            ->leftJoin('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->leftJoin('positions', 'positions.id', 'lgu_positions.position_id')
            ->leftJoin('salary_grades', 'salary_grades.id', 'positions.salary_grade_id')
            ->leftJoin('divisions', 'divisions.id', 'lgu_positions.division_id')
            ->leftJoin('offices', "offices.id", 'divisions.office_id')
            ->groupBy('positions.title', 'salary_grades.number', 'offices.office_code', 'divisions.division_code')
            ->get();

        $templateProcessor = new TemplateProcessor(public_path() . "\Word Templates\Meeting.docx");
        // replace value in the template
        $templateProcessor->setValue("date_created", date('F j, Y', strtotime($interview->date_created)));
        $templateProcessor->setValue("meeting_date", date('F j, Y', strtotime($interview->meeting_date)));
        $templateProcessor->setValue("venue", $interview->venue->name);
        $templateProcessor->setValue("governor", $governor_name);


        $templateProcessor->cloneRow("no", count($positions));

        foreach ($positions as $key => $value) {
            $i = $key + 1;
            // $count="";
            // if($value->count>1){
            $count = "($value->count)";
            // }
            $templateProcessor->setValue("no#$i", $i);
            $templateProcessor->setValue("position#$i", "$value->title $count");
            $templateProcessor->setValue("salary_grade#$i", "$value->number");
            $templateProcessor->setValue("office#$i", $value->office_code);
        }


        $templateProcessor->saveAs($filePath);
        $fileContents = file_get_contents($filePath);
        $base64 = base64_encode($fileContents);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        return $this->success(compact('base64', 'filename'), 'Successfully Retrieved.', 200);
    }


    public function getCardData()
    {

        $year = date('Y');

        $total_employees = Employee::select("employees.id")
            ->whereIn('employee_status', ['Active', 'On-leave', 'Suspended'])
            ->count();

        $total_permanent_plantillas = LguPosition::select('lgu_positions.id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
            ->join('offices', 'offices.id', 'divisions.office_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->where([['position_status', 'Permanent'], ['lgu_positions.status', 'Active']])
            ->count();

        $vacant_permanent_positions = LguPosition::select('lgu_positions.id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
            ->join('offices', 'offices.id', 'divisions.office_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->leftJoin('employees', 'lgu_positions.id', 'employees.lgu_position_id')
            ->where(function ($vacant_positions) {
                $vacant_positions->whereIn('position_status', ['permanent'])->where([['employees.employee_status', '<>', 'Active'], ['lgu_positions.status', 'Active']]);
            })
            ->orWhere(function ($vacant_positions) {
                $vacant_positions->whereIn('position_status', ['permanent'])->whereNull('employees.employee_status')->where([['lgu_positions.status', 'Active']]);
            })
            ->distinct('lgu_positions.id')
            ->count();

        $received_applications =
            Application::select(
                "*",
                "applications.id  as id",
                "offices.office_name",
                "divisions.division_name",
                "first_name",
                "middle_name",
                "last_name",
                "suffix",
                "title",
                "item_number",
                "application_type",
                "applications.status",
                "applications.date_submitted",
            )
            ->join("vacancies", "applications.vacancy_id", "vacancies.id")
            ->join("lgu_positions", "lgu_positions.id", "vacancies.lgu_position_id")
            ->join("positions", "positions.id", "lgu_positions.position_id")
            ->join("divisions", "lgu_positions.division_id", "divisions.id")
            ->join("offices", "offices.id", "divisions.office_id")
            ->join("salary_grades", "positions.salary_grade_id", "salary_grades.id")
            ->leftJoin("disqualifications", "applications.id", "disqualifications.application_id")
            ->leftJoin("notices", "applications.id", "notices.application_id")
            ->where("applications.date_submitted", "like", "%" . $year . "%")
            ->count();

        return compact(
            'total_employees',
            'total_permanent_plantillas',
            'vacant_permanent_positions',
            'received_applications'
        );
    }


    public function getPersonnelPerOffice()
    {

        $offices = Office::select('office_code')->get()->toArray();
        $data = [];
        $rawData = Employee::select("offices.office_code", DB::raw("COUNT(employees.id) as count"))
            ->whereIn('employee_status', ['Active', 'On-leave', 'Suspended'])
            ->join("divisions", "employees.division_id", "divisions.id")
            ->join("offices", "offices.id", "divisions.office_id")
            ->groupBy("offices.office_code")
            ->get();

        //restructure and  insert data
        $label = array_map(function ($item) use ($data) {
            array_push($data, 0);
            return $item["office_code"];
        }, $offices);

        foreach ($offices as $item) {
            array_push($data, 0);
        }

        foreach ($rawData as $item) {
            $key = array_search($item->office_code, $label);
            $data[$key] = $item->count;
        }

        return compact('label', 'data');
    }


    public function getApplicantionsPerMonth()
    {
        $label = [];
        $data = [];
        $year = date('Y');
        $month = (int)date('m');

        for ($i = 1; $i <= $month; $i++) {
            array_push($label,  Carbon::create()->month($i)->format('F'));
            array_push($data, 0);
        }

        $rawData = Application::selectRaw('MONTH(date_submitted) as month, COUNT(*) as count')
            ->where("date_submitted", "like", "%" . $year . "%")
            ->groupBy('month')
            ->get();

        foreach ($rawData as $item) {
            $key = array_search(Carbon::create()->month($item->month)->format('F'), $label);
            $data[$key] = $item->count;
        }


        return compact('label', 'data');
    }



    function getPersonnel()
    {
        $label = [];
        $data = [];
        $rows = Employee::select("employees.employment_status", DB::raw("COUNT(employees.id) as count"))
            ->whereIn('employee_status', ['Active', 'On-leave', 'Suspended'])
            ->groupBy("employees.employment_status")
            ->get();


        foreach ($rows as $item) {
            array_push($label, $item->employment_status);
            array_push($data, $item->count);
        }

        return compact('label', 'data');
    }
}
