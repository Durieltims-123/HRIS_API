<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\StorePSBResultRequest;
use App\Http\Resources\DivisionResource;
use App\Models\Application;
use App\Models\Employee;
use App\Models\Division;
use App\Models\Vacancy;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Governor;
use App\Models\PersonnelSelectionBoard;
use App\Models\Interview;
use App\Models\LguPosition;
use App\Models\Office;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpWord\TemplateProcessor;
use ZipArchive;
use Carbon\Carbon;

class PSBResultController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DivisionResource::collection(
            Division::with('office')
                ->join('offices', 'offices.id', 'divisions.office_id')
                ->orderBy('office_name', 'asc')
                ->get()
        )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisionRequest $request)
    {
        $request->validated($request->all());

        $divisionExist = Division::where('division_code', $request->code)->orWhere([["division_name", $request->name], ["office_id", $request->office_id]])->exists();
        if ($divisionExist) {
            return $this->error('', 'Duplicate Entry', 400);
        } else {
            Division::create([
                "division_code" => $request->code,
                "division_name" => $request->name,
                "office_id" => $request->office_id,
                "division_type" => $request->type,
            ]);

            return $this->success('', 'Successfully Saved', 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $psbResult)
    {
        $vacancy = $psbResult;
        $division = $psbResult->lguPosition->division;
        $office = $division->office;
        $lguPosition = $psbResult->lguPosition;
        $position = $psbResult->lguPosition->position;
        $applications = DB::table('applications')
            ->select("*")
            ->where('applications.vacancy_id', $psbResult->id)
            ->join('assessments', 'assessments.application_id', 'applications.id')->get();

        return compact(
            "vacancy",
            "division",
            "office",
            "lguPosition",
            "position",
            "applications"
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePSBResultRequest $request, Vacancy $psbResult)
    {

        foreach ($request->applications as $item) {
            $application = Application::find($item["id"]);
            $assessment = $application->assessment;

            $total_remark = $assessment->performance + $assessment->education + $assessment->experience + $request->psychosocial_attributes + $request->potential + $request->administrative + $request->technical + $request->leadership + $request->awards;

            $application->assessment->update([
                'appropriate_eligibility' => $assessment->appropriate_eligibility,
                'training' => $assessment->training,
                'performance' => $assessment->performance,
                'education' => $assessment->education,
                'experience' => $assessment->experience,
                'psychosocial_attributes' => $item['psychosocial_attributes'],
                'potential' => $item['potential'],
                'administrative' => $item['administrative'],
                'technical' => $item['technical'],
                'leadership' => $item['leadership'],
                'awards' => $item['awards'],
                'total_remarks' => $total_remark,
                'additional_information' => $item['additional_information'],
                'remarks' => $item['remarks']
            ]);
        }

        return $this->success('', 'Successfully Updated PSB Result.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        $employeesExists = Employee::where('division_id', $division->id)->exists();
        if ($employeesExists) {
            return $this->error('', 'You cannot delete Division with existing employees.', 400);
        } else {
            $division->delete();
            return $this->success('', 'Successfully Deleted', 200);
        }
    }

    public function search(Request $request)
    {

        $activePage = $request->activePage;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $orderBy == null ? $orderBy = "divisions.id" : $orderBy = $orderBy;
        $filters = $request->filters;


        if (!is_null($request->multiFilter)) {
            $value = $filters[0]['value'];
            $data = DivisionResource::collection(
                Division::select('divisions.id', 'division_code', 'division_name', 'office_name', 'divisions.division_type')
                    ->where('divisions.division_code', 'like', '%' . $value . '%')
                    ->orWhere('divisions.division_name', 'like', '%' . $value . '%')
                    ->orWhere('office_name', 'like', '%' . $value . '%')
                    ->orWhere('office_code', 'like', '%' . $value . '%')
                    ->skip(($activePage - 1) * 10)
                    ->orderBy($orderBy, $orderAscending)
                    ->join('offices', 'offices.id', 'divisions.office_id')
                    ->take(10)
                    ->get()
            );


            $pages = Division::select('divisions.id', 'division_code', 'division_name', 'office_name')
                ->where('divisions.division_code', 'like', '%' . $value . '%')
                ->orWhere('divisions.division_name', 'like', '%' . $value . '%')
                ->orWhere('office_name', 'like', '%' . $value . '%')
                ->orWhere('office_code', 'like', '%' . $value . '%')
                ->join('offices', 'offices.id', 'divisions.office_id')
                ->orderBy($orderBy, $orderAscending)
                ->count();
        } else {
            if (!is_null($filters)) {
                $filters =  array_map(function ($filter) {
                    if ($filter['column'] === "id") {
                        return ['divisions.id', 'like', '%' . $filter['value'] . '%'];
                    } else {
                        return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                    }
                }, $filters);
            } else {
                $filters = [['divisions.id', 'like', '%']];
            }

            $data = DivisionResource::collection(
                Division::select('divisions.id', 'division_code', 'division_name', 'office_name', 'divisions.division_type')
                    ->where($filters)
                    ->skip(($activePage - 1) * 10)
                    ->orderBy($orderBy, $orderAscending)
                    ->join('offices', 'offices.id', 'divisions.office_id')
                    ->take(10)
                    ->get()
            );

            $pages = Division::select('divisions.id', 'division_code', 'division_name', 'office_name')
                ->where($filters)
                ->join('offices', 'offices.id', 'divisions.office_id')
                ->orderBy($orderBy, $orderAscending)
                ->count();
        }



        return compact('pages', 'data');
    }


    public function generateComparativeAssessementForm(Vacancy $vacancy)
    {

        $templatePath = public_path('/Excel Templates/CAF.xlsx');
        $templatePath2 = public_path('/Excel Templates/CAF-DH.xlsx');


        $lgu_position = $vacancy->lguPosition;
        $position = $lgu_position->position;
        $qualification_standard = $position->qualificationStandards;
        $division = $lgu_position->division;
        $office = $division->office;
        $head = false;
        $interview = $vacancy->vacancyInterview->interview;

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

        // fill signatories
        $start = [24, 31];
        $cols = ["A", "I", "M"];
        $members = [];
        $names = [];
        $psb = PersonnelSelectionBoard::orderBy('id', 'desc')->first();
        $psb_members = $psb->psbPersonnels()->where('role', 'Member')->orderBy('id', 'asc')->get();
        // array_push($members, "$psb->chairman_prefix $psb->chairman, $psb->chairman_position, Chairman");
        // array_push($names, "$psb->chairman_prefix $psb->chairman");
        array_push($members, [
            "name" => strtoupper(strtolower("$psb->vice_chairman")),
            "position" => $psb->vice_chairman_position,
            "role" => "Vice Chairman"
        ]);
        array_push($names, "$psb->vice_chairman");

        foreach ($psb_members as $member) {
            array_push($members, [
                "name" => strtoupper(strtolower("$member->name")),
                "position" => $member->position,
                "role" => "Member"
            ]);
            array_push($names, "$member->name");
        }

        $department_head = DB::table('vacancy_interviews')
            ->select('department_heads.prefix', 'department_heads.name',  'department_heads.position', 'offices.office_name', DB::raw('count(*) as count'))
            ->where([['offices.id', $office->id], ['department_heads.status', 'Active']])
            ->leftJoin('vacancies', 'vacancies.id', 'vacancy_interviews.vacancy_id')
            ->leftJoin('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->leftJoin('divisions', 'divisions.id', 'lgu_positions.division_id')
            ->leftJoin('offices', "offices.id", 'divisions.office_id')
            ->leftJoin('department_heads', "offices.id", 'divisions.office_id')
            ->groupBy('department_heads.prefix', 'department_heads.name', 'department_heads.position', 'offices.office_name')
            ->first();

        if (!in_array("$department_head->prefix $department_head->name", $names)) {
            array_push($members, [
                "name" => strtoupper(strtolower("$department_head->name")),
                "position" => $department_head->position,
                "role" => "member"
            ]);
            array_push($names, "$department_head->name");
        }

        $governor = Governor::latest()->first();
        $governor_name = strtoupper(strtolower($governor->name . " " . $governor->suffix));
        // salary_grade
        $sg = $position->salaryGrade->number;

        $permanents = [];

        $next = DB::table("applications")
            ->select('applications.*')
            ->where([['vacancy_id', $vacancy->id], ['application_type', 'Insider-Permanent'], ['salary_grades.number', '<=', $sg]])
            ->whereIn('applications.status', ['Shortlisted', 'Interviewed'])
            ->leftJoin('employees', 'employees.id', 'applications.individual_id')
            ->leftJoin('lgu_positions', 'employees.lgu_position_id', 'lgu_positions.id')
            ->leftJoin('positions', 'lgu_positions.position_id', 'positions.id')
            ->leftJoin('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->orderBy('salary_grades.number', 'desc')
            ->orderBy('applications.last_name', 'asc')
            ->get();

        foreach ($next as $data) {
            array_push($permanents, $data);
        }

        $demotions = DB::table("applications")
            ->select('applications.*')
            ->where([['vacancy_id', $vacancy->id], ['application_type', 'Insider-Permanent'], ['salary_grades.number', '>', $sg]])
            ->whereIn('applications.status', ['Shortlisted', 'Interviewed'])
            ->leftJoin('employees', 'employees.id', 'applications.individual_id')
            ->leftJoin('lgu_positions', 'employees.lgu_position_id', 'lgu_positions.id')
            ->leftJoin('positions', 'lgu_positions.position_id', 'positions.id')
            ->leftJoin('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->orderBy('salary_grades.number', 'desc')
            ->orderBy('applications.last_name', 'asc')
            ->get();


        foreach ($demotions as $date) {
            array_push($permanents, $date);
        }

        $casuals = DB::table("applications")
            ->select('applications.*')
            ->where([['vacancy_id', $vacancy->id], ['application_type', 'Insider-Casual']])
            ->whereIn('applications.status', ['Shortlisted', 'Interviewed'])
            ->leftJoin('employees', 'employees.id', 'applications.individual_id')
            ->leftJoin('lgu_positions', 'employees.lgu_position_id', 'lgu_positions.id')
            ->leftJoin('positions', 'lgu_positions.position_id', 'positions.id')
            ->leftJoin('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->orderBy('salary_grades.number', 'desc')
            ->orderBy('applications.last_name', 'asc')
            ->get();


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
        $meeting_date = Date('F j, Y', strtotime($interview->meeting_date));

        if (count($permanents) > 0) {
            // fill position details
            $worksheet->setCellValue("G3", $position->title);
            $worksheet->setCellValue("M3", $position->salaryGrade->amount);
            $worksheet->setCellValue("M4", $position->salaryGrade->number);
            $worksheet->setCellValue("O3", $office->office_name);
            $worksheet->setCellValue("O4", $division_name);
            $worksheet->setCellValue("F6", $qualification_standard->education);
            $worksheet->setCellValue("M6", $qualification_standard->training);
            $worksheet->setCellValue("F7", $qualification_standard->experience);
            $worksheet->setCellValue("M7", $qualification_standard->eligibility);
            $worksheet->setCellValue("A19", "by the Human Resource Merit Promotion and Selection Board on $meeting_date and that they meet the required qualification ");
            $worksheet->setCellValue("A20", $richText);

            // Add signatories

            $arrays = [];
            foreach ($members as $i => $member) {
                if ((($i + 1) % 3) == 0) {
                    $column = $cols[2];
                } else {
                    $column = $cols[(($i + 1) % 3) - 1];
                }

                if ($i < 3) {
                    $row = $start[0];
                } else {
                    $row = $start[1];
                }

                // set values
                $worksheet->setCellValue("$column$row", $member["name"]);
                $worksheet->setCellValue("$column" . ($row + 1), $member["position"]);
                $worksheet->setCellValue("$column" . ($row + 2), $member["role"]);
            }

            $worksheet->setCellValue("O31", $governor_name);




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

                            $worksheet->setCellValue("G3", $position->title);
                        }
                    }
                }
            }
            // Insert Application Details
            $counter = 0;
            foreach ($permanents as $index => $permanent) {

                $permanent = Application::find($permanent->id);
                $row = $startRow + ($counter * $rowsToDuplicate);
                $worksheet->setCellValue("A" . $row, ($counter + 1));

                $personalInformation = $permanent->individual->latestPersonalDataSheet->personalInformation;

                $address = $personalInformation->permanent_barangay . "," . ucwords(strtolower($personalInformation->permanent_municipality)) . "," . ucwords(strtolower($personalInformation->permanent_province));
                $age_civil_status = $personalInformation->age . "/" . $personalInformation->civil_status;

                // Employee Details
                $middle_initial = ($permanent->middle_name != '') ? " " . $permanent->middle_name[0] . ". " : " ";
                $worksheet->setCellValue("C" . $row, strtoupper(strtolower($permanent->first_name . $middle_initial . $permanent->last_name)));
                $worksheet->setCellValue("F" . $row + 1, $permanent->individual->lguPosition->position->title . "/ SG-" . $permanent->individual->lguPosition->position->salaryGrade->number);
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
                if ($head) {
                    $worksheet->setCellValue("O" . $row, $permanent->assessment->administrative);
                    $worksheet->setCellValue("P" . $row, $permanent->assessment->technical);
                    $worksheet->setCellValue("Q" . $row, $permanent->assessment->leadership);
                    $worksheet->setCellValue("R" . $row, $permanent->assessment->awards);
                } else {
                    $worksheet->setCellValue("O" . $row, $permanent->assessment->psychosocial_attributes);
                    $worksheet->setCellValue("P" . $row, $permanent->assessment->potential);
                    $worksheet->setCellValue("Q" . $row, $permanent->assessment->awards);
                }
                $worksheet->setCellValue("T" . $row, $permanent->assessment->additional_information);
                $worksheet->setCellValue("U" . $row, $permanent->assessment->remarks);
                if ($head) {
                    $worksheet->setCellValue("O" . $row, $permanent->assessment->administrative);
                    $worksheet->setCellValue("P" . $row, $permanent->assessment->technical);
                    $worksheet->setCellValue("Q" . $row, $permanent->assessment->leadership);
                    $worksheet->setCellValue("R" . $row, $permanent->assessment->awards);
                } else {
                    $worksheet->setCellValue("O" . $row, $permanent->assessment->psychosocial_attributes);
                    $worksheet->setCellValue("P" . $row, $permanent->assessment->potential);
                    $worksheet->setCellValue("Q" . $row, $permanent->assessment->awards);
                }
                $worksheet->setCellValue("T" . $row, $permanent->assessment->additional_information);
                $worksheet->setCellValue("U" . $row, $permanent->assessment->remarks);
                $worksheet->setCellValue("S" . $row, '=SUM(K' . $row . ':R' . $row . ')');

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
            // fill position details
            $worksheet->setCellValue("G3", $position->title);
            $worksheet->setCellValue("M3", $position->salaryGrade->amount);
            $worksheet->setCellValue("M4", $position->salaryGrade->number);
            $worksheet->setCellValue("O3", $office->office_name);
            $worksheet->setCellValue("O4", $division_name);
            $worksheet->setCellValue("F6", $qualification_standard->education);
            $worksheet->setCellValue("M6", $qualification_standard->training);
            $worksheet->setCellValue("F7", $qualification_standard->experience);
            $worksheet->setCellValue("M7", $qualification_standard->eligibility);
            $worksheet->setCellValue("A19", "by the Human Resource Merit Promotion and Selection Board on $meeting_date and that they meet the required qualification ");
            $worksheet->setCellValue("A20", $richText);

            // Add signatories

            $arrays = [];
            foreach ($members as $i => $member) {
                if ((($i + 1) % 3) == 0) {
                    $column = $cols[2];
                } else {
                    $column = $cols[(($i + 1) % 3) - 1];
                }

                if ($i < 3) {
                    $row = $start[0];
                } else {
                    $row = $start[1];
                }

                // set values
                $worksheet->setCellValue("$column$row", $member["name"]);
                $worksheet->setCellValue("$column" . ($row + 1), $member["position"]);
                $worksheet->setCellValue("$column" . ($row + 2), $member["role"]);
            }

            $worksheet->setCellValue("O31", $governor_name);
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

                            $worksheet->setCellValue("G3", $position->title);
                        }
                    }
                }
            }

            // Insert Application Details
            $counter = 0;
            foreach ($casuals as $index => $casual) {

                $casual = Application::find($casual->id);
                $row = $startRow + ($counter * $rowsToDuplicate);
                $worksheet->setCellValue("A" . $row, ($counter + 1));

                $personalInformation = $casual->individual->latestPersonalDataSheet->personalInformation;
                $address = $personalInformation->permanent_barangay . "," . ucwords(strtolower($personalInformation->permanent_municipality)) . "," . ucwords(strtolower($personalInformation->permanent_province));
                $age_civil_status = $personalInformation->age . "/" . $personalInformation->civil_status;

                // Employee Detail
                $middle_initial = ($casual->middle_name != '') ? " " . $casual->middle_name[0] . ". " : " ";
                $worksheet->setCellValue("C" . $row, strtoupper(strtolower($casual->first_name . $middle_initial . $casual->last_name)));
                $worksheet->setCellValue("F" . $row + 1, $casual->individual->lguPosition->position->title . "/ SG-" . $casual->individual->lguPosition->position->salaryGrade->number);
                $worksheet->setCellValue("F" . $row + 2, $address);
                $worksheet->setCellValue("F" . $row + 3, $age_civil_status);
                $worksheet->setCellValue("I" . $row, $casual->assessment->appropriate_eligibility);
                $worksheet->getStyle("I" . $row)->getAlignment()->setWrapText(true);
                $worksheet->getStyle("F" . $row . ":F" . $row + 3)->getAlignment()->setWrapText(true);

                $worksheet->setCellValue("J" . $row, $casual->assessment->training);
                $worksheet->setCellValue("K" . $row, $casual->assessment->performance);
                $worksheet->setCellValue("L" . $row, $casual->assessment->education);
                $worksheet->setCellValue("M" . $row, $casual->assessment->experience);
                if ($head) {
                    $worksheet->setCellValue("O" . $row, $casual->assessment->administrative);
                    $worksheet->setCellValue("P" . $row, $casual->assessment->technical);
                    $worksheet->setCellValue("Q" . $row, $casual->assessment->leadership);
                    $worksheet->setCellValue("R" . $row, $casual->assessment->awards);
                } else {
                    $worksheet->setCellValue("O" . $row, $casual->assessment->psychosocial_attributes);
                    $worksheet->setCellValue("P" . $row, $casual->assessment->potential);
                    $worksheet->setCellValue("Q" . $row, $casual->assessment->awards);
                }
                $worksheet->setCellValue("T" . $row, $casual->assessment->additional_information);
                $worksheet->setCellValue("U" . $row, $casual->assessment->remarks);
                if ($head) {
                    $worksheet->setCellValue("O" . $row, $casual->assessment->administrative);
                    $worksheet->setCellValue("P" . $row, $casual->assessment->technical);
                    $worksheet->setCellValue("Q" . $row, $casual->assessment->leadership);
                    $worksheet->setCellValue("R" . $row, $casual->assessment->awards);
                } else {
                    $worksheet->setCellValue("O" . $row, $casual->assessment->psychosocial_attributes);
                    $worksheet->setCellValue("P" . $row, $casual->assessment->potential);
                    $worksheet->setCellValue("Q" . $row, $casual->assessment->awards);
                }
                $worksheet->setCellValue("T" . $row, $casual->assessment->additional_information);
                $worksheet->setCellValue("U" . $row, $casual->assessment->remarks);
                $worksheet->setCellValue("S" . $row, '=SUM(K' . $row . ':R' . $row . ')');

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
            // fill position details
            $worksheet->setCellValue("G3", $position->title);
            $worksheet->setCellValue("M3", $position->salaryGrade->amount);
            $worksheet->setCellValue("M4", $position->salaryGrade->number);
            $worksheet->setCellValue("O3", $office->office_name);
            $worksheet->setCellValue("O4", $division_name);
            $worksheet->setCellValue("F6", $qualification_standard->education);
            $worksheet->setCellValue("M6", $qualification_standard->training);
            $worksheet->setCellValue("F7", $qualification_standard->experience);
            $worksheet->setCellValue("M7", $qualification_standard->eligibility);
            $worksheet->setCellValue("A19", "by the Human Resource Merit Promotion and Selection Board on $meeting_date and that they meet the required qualification ");
            $worksheet->setCellValue("A20", $richText);

            // Add signatories

            $arrays = [];
            foreach ($members as $i => $member) {
                if ((($i + 1) % 3) == 0) {
                    $column = $cols[2];
                } else {
                    $column = $cols[(($i + 1) % 3) - 1];
                }

                if ($i < 3) {
                    $row = $start[0];
                } else {
                    $row = $start[1];
                }

                // set values
                $worksheet->setCellValue("$column$row", $member["name"]);
                $worksheet->setCellValue("$column" . ($row + 1), $member["position"]);
                $worksheet->setCellValue("$column" . ($row + 2), $member["role"]);
            }

            $worksheet->setCellValue("O31", $governor_name);


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

                            $worksheet->setCellValue("G3", $position->title);
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
                $address = $personalInformation->permanent_barangay . "," . ucwords(strtolower($personalInformation->permanent_municipality)) . "," . ucwords(strtolower($personalInformation->permanent_province));
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
                if ($head) {
                    $worksheet->setCellValue("O" . $row, $outsider->assessment->administrative);
                    $worksheet->setCellValue("P" . $row, $outsider->assessment->technical);
                    $worksheet->setCellValue("Q" . $row, $outsider->assessment->leadership);
                    $worksheet->setCellValue("R" . $row, $outsider->assessment->awards);
                } else {
                    $worksheet->setCellValue("O" . $row, $outsider->assessment->psychosocial_attributes);
                    $worksheet->setCellValue("P" . $row, $outsider->assessment->potential);
                    $worksheet->setCellValue("Q" . $row, $outsider->assessment->awards);
                }
                $worksheet->setCellValue("T" . $row, $outsider->assessment->additional_information);
                $worksheet->setCellValue("U" . $row, $outsider->assessment->remarks);
                if ($head) {
                    $worksheet->setCellValue("O" . $row, $outsider->assessment->administrative);
                    $worksheet->setCellValue("P" . $row, $outsider->assessment->technical);
                    $worksheet->setCellValue("Q" . $row, $outsider->assessment->leadership);
                    $worksheet->setCellValue("R" . $row, $outsider->assessment->awards);
                } else {
                    $worksheet->setCellValue("O" . $row, $outsider->assessment->psychosocial_attributes);
                    $worksheet->setCellValue("P" . $row, $outsider->assessment->potential);
                    $worksheet->setCellValue("Q" . $row, $outsider->assessment->awards);
                }
                $worksheet->setCellValue("T" . $row, $outsider->assessment->additional_information);
                $worksheet->setCellValue("U" . $row, $outsider->assessment->remarks);
                $worksheet->setCellValue("S" . $row, '=SUM(K' . $row . ':R' . $row . ')');

                $counter++;
            }
        } else {
            $activeSheetIndex = $spreadsheet->getActiveSheetIndex();
            $spreadsheet->removeSheetByIndex($activeSheetIndex);
        }


        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = "$position->title - $lgu_position->item_number(Final-CAF)";
        $filePath = public_path("/Excel Results/$filename.xlsx");
        $writer->save($filePath);

        $fileContents = file_get_contents($filePath);
        $base64 = base64_encode($fileContents);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        return $this->success(compact('base64', 'filename'), 'Successfully Retrieved.', 200);
    }
}
