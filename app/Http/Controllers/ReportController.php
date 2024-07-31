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
        $filesToZip = [
            public_path() . "\Excel Templates\CAF.xlsx", // Path to file 1
            public_path() . "\Excel Templates\CAF.xlsx", // Path to file 1
        ];

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {


            foreach ($interview->vacancyInterview as $vacancy) {
                return $vacancy;
            }


            // foreach ($filesToZip as $file) {
            //     $zip->addFile($file, basename($file));
            // }
            // $zip->close();
        }

        // $zip_file = public_path() . '\\' . 'zips/PSB-' . $interview->meeting_date . '.zip';
        // $zip = new \ZipArchive();
        // $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        // // foreach ($file_names as $key => $file_name) {
        // $zip->addFile(public_path() . "\Excel Templates\CAF.xlsx");
        // // }
        // $zip->close();



        // $worksheet = $spreadsheet->setActiveSheetIndexByName("Sheet1");
        // $worksheet->getCell('A1')->setValue(strtoupper(strtolower(date("F j, Y", strtotime($date_opened)) . " OPENING")));
        // $worksheet->getCell('L1')->setValue($due);



        return $interview->vacancyInterview;
        // $plantilla = $application->vacancy->lguPosition;
        // $position = $plantilla->position;
        // $filename = $application->first_name . " " . $application->last_name . " (" . $position->title . "-" . $plantilla->item_number . " ) - Letter of Disqualification ";
        // $filePath = public_path('\Word Results\\' . $filename . ".docx");
        // $personalinformation = $application->individual->latestPersonalDataSheet->personalInformation;
        // $address = $personalinformation->residential_house . "," . $personalinformation->residential_barangay . "," . ucwords(strtolower($personalinformation->residential_municipality)) . "," . ucwords(strtolower($personalinformation->residential_province));
        // $prefix = "Ms";
        // if ($personalinformation->sex === "Male") {
        //     $prefix = "Mr.";
        // }


        // $governor = Governor::latest()->first();
        // $governor_name = $governor->prefix . " " . $governor->name . " " . $governor->suffix;

        // $templateProcessor = new TemplateProcessor(public_path() . "\Word Templates\Letter of Disqualification.docx");
        // // replace value in the template
        // $templateProcessor->setValue("date", date('F j, Y'));
        // $templateProcessor->setValue("name", $application->first_name . ' ' . strtoupper($application->middle_name[0]) . '.  ' . $application->last_name);
        // $templateProcessor->setValue("address", $address);
        // $templateProcessor->setValue("prefix", $prefix);
        // $templateProcessor->setValue("last_name", $application->last_name);
        // $templateProcessor->setValue("phone_number", $personalinformation->mobile_number);
        // $templateProcessor->setValue("position", $position->title);
        // $templateProcessor->setValue("office", $plantilla->division->office->office_name);
        // $templateProcessor->setValue("reason", $application->disqualification->reason);
        // $templateProcessor->setValue("governor", $governor_name);


        // $templateProcessor->saveAs($filePath);
        // $fileContents = file_get_contents($filePath);
        // $base64 = base64_encode($fileContents);


        // return $this->success(compact('base64', 'filename'), 'Successfully Retrieved.', 200);
    }
}
