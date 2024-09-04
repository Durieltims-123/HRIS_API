<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Http\Resources\NoticeToApplicantResource;
use App\Models\Application;
use App\Models\Governor;
use App\Models\Interview;
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



class NoticeToApplicantController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoticeResource::collection(
            Notice::with('belongsToApplication')->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeRequest $request)
    {
        $request->validated($request->all());

        Notice::create([
            "application_id" => $request->application_id,
            "notice_type" => $request->notice_type,
            "date_sent" => $request->date_sent,
            "date_received" => $request->date_received
        ]);

        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        return (new NoticeResource($notice->loadMissing(['belongsToApplication'])));
        // return new NoticeResource($notice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit() {}

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreNoticeRequest $request, Notice $notice)
    {
        $notice->application_id = $request->application_id;
        $notice->date_sent = $request->date_sent;
        $notice->notice_type = $request->notice_type;
        $notice->date_received = $request->date_received;

        $notice->save();

        return new NoticeResource($notice);
    }



    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $status = $request->status;
        $havingData = "";
        // initial test
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $year = $request->year;
        $filters = $request->filters;

        $filterApplicantFilter = array_filter($filters, function ($filter) {
            return $filter['column'] === "applicants";
        });

        $filters = array_filter($filters, function ($filter) {
            return $filter['column'] != "applicants";
        });

        if (count($filterApplicantFilter) > 0) {
            $havingData = $filterApplicantFilter[0]['value'];
        }
        if (!is_null($filters)) {
            $filters =  array_map(function ($filter) {
                if ($filter['column'] === "id") {
                    return ['vacancies.id', 'like', '%' . $filter['value'] . '%'];
                } else {
                    return [$filter['column'], 'like', '%' . $filter['value'] . '%'];
                }
            }, $filters);
        } else {
            $filters = [['vacancies.id', 'like', '%']];
        }

        if ($request->positionStatus) {
            array_push($filters, ['lgu_positions.position_status', 'like', $request->positionStatus]);
        }

        $orderAscending  ? $orderAscending = 'asc' : $orderAscending = 'desc';
        ($orderBy == null || $orderBy == 'id') ? $orderBy = 'vacancies.id' : $orderBy = $orderBy;

        $data = NoticeToApplicantResource::collection(Vacancy::select(
            'lgu_positions.id as lgu_position_id',
            'vacancies.id',
            'vacancies.date_submitted',
            'date_queued',
            'date_approved',
            'posting_date',
            'closing_date',
            'division_name',
            'office_name',
            'division_id',
            'positions.id as position_id',
            'year',
            'title',
            'number',
            'amount',
            'item_number',
            'education',
            'training',
            'experience',
            'eligibility',
            'competency',
            'vacancies.status',
            'description',
            'place_of_assignment',
            'position_status',
            'publication_status',
            DB::raw('COUNT(lgu_positions.id) as applicants')
        )
            ->leftJoin('publications', 'publications.vacancy_id', 'vacancies.id')
            ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
            ->join('offices', 'offices.id', 'divisions.office_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->join('applications', 'applications.vacancy_id', 'vacancies.id')
            ->join('vacancy_interviews', 'vacancy_interviews.vacancy_id', 'vacancies.id')
            ->where($filters)
            ->groupBy(
                'lgu_positions.id',
                'vacancies.id',
                'vacancies.date_submitted',
                'date_queued',
                'date_approved',
                'posting_date',
                'closing_date',
                'division_name',
                'office_name',
                'division_id',
                'positions.id',
                'year',
                'title',
                'number',
                'amount',
                'item_number',
                'education',
                'training',
                'experience',
                'eligibility',
                'competency',
                'vacancies.status',
                'description',
                'place_of_assignment',
                'position_status',
                'publication_status',
            )
            ->having('applicants', 'like', "%$havingData%")
            ->skip(($activePage - 1) * 10)
            ->orderBy($orderBy, $orderAscending)
            ->take(10)
            ->get());

        $pages = Vacancy::select(
            'lgu_positions.id as lgu_position_id',
            'vacancies.id',
            'vacancies.date_submitted',
            'date_queued',
            'date_approved',
            'posting_date',
            'closing_date',
            'division_name',
            'office_name',
            'division_id',
            'positions.id as position_id',
            'year',
            'title',
            'number',
            'amount',
            'item_number',
            'education',
            'training',
            'experience',
            'eligibility',
            'competency',
            'vacancies.status',
            'description',
            'place_of_assignment',
            'position_status',
            'publication_status',
            DB::raw('COUNT(lgu_positions.id) as applicants')
        )
            ->leftJoin('publications', 'publications.vacancy_id', 'vacancies.id')
            ->join('lgu_positions', 'lgu_positions.id', 'vacancies.lgu_position_id')
            ->join('positions', 'positions.id', 'lgu_positions.position_id')
            ->join('divisions', 'lgu_positions.division_id', 'divisions.id')
            ->join('offices', 'offices.id', 'divisions.office_id')
            ->join('salary_grades', 'positions.salary_grade_id', 'salary_grades.id')
            ->join('qualification_standards', 'positions.id', 'qualification_standards.position_id')
            ->leftJoin('position_descriptions', 'lgu_positions.id', 'position_descriptions.lgu_position_id')
            ->join('applications', 'applications.vacancy_id', 'vacancies.id')
            ->join('vacancy_interviews', 'vacancy_interviews.vacancy_id', 'vacancies.id')
            ->where($filters)
            ->groupBy(
                'lgu_positions.id',
                'vacancies.id',
                'vacancies.date_submitted',
                'date_queued',
                'date_approved',
                'posting_date',
                'closing_date',
                'division_name',
                'office_name',
                'division_id',
                'positions.id',
                'year',
                'title',
                'number',
                'amount',
                'item_number',
                'education',
                'training',
                'experience',
                'eligibility',
                'competency',
                'vacancies.status',
                'description',
                'place_of_assignment',
                'position_status',
                'publication_status',
            )
            ->having('applicants', 'like', "%$havingData%")
            ->count();

        return compact('pages', 'data', 'havingData');
    }


    function generateNoticeToApplicants(Vacancy $vacancy)
    {
        $lgu_position = $vacancy->lguPosition;
        $division = $lgu_position->division;
        $position = $lgu_position->position;
        $filename =  "$position->title - $lgu_position->item_number ";
        $filePath = public_path('\Word Results\\' . $filename . ".docx");

        $governor = Governor::latest()->first();
        $governor_name = $governor->prefix . " " . $governor->name . " " . $governor->suffix;
        $interview = Interview::find($vacancy->vacancyInterview->interview_id);

        $templateProcessor = new TemplateProcessor(public_path() . "\Word Templates\Notice.docx");
        //  replace value in the template
        $templateProcessor->setValue("date_created", date('F j, Y', strtotime($interview->date_created)));
        $templateProcessor->setValue("meeting_date", date('F j, Y', strtotime($interview->meeting_date)));
        $templateProcessor->setValue("position", $position->title);
        $templateProcessor->setValue("office", $division->division_name);
        $templateProcessor->setValue("day",  date('w', strtotime($interview->meeting_date)));
        $templateProcessor->setValue("venue", $interview->venue->name);
        $templateProcessor->setValue("governor", $governor_name);

        $applications = Application::where([['shortlisted', 1], ['vacancy_id', $vacancy->id]])->orderBy('last_name')->get();

        $applicant_count = count($applications);
        if ($applicant_count > 20) {
            $iteration = (int)($applicant_count / 2);
            $remainder = $applicant_count % 2;
            if ($remainder > 0) {
                $iteration = $iteration + 1;
            }
            $templateProcessor->cloneRow("dno", $iteration);

            for ($x = 0; $x < $iteration; $x++) {

                $i = $x + 1;
                $i2 = ($iteration + $x + 1);

                // value 1
                $value1 = $applications[$x];
                if ($value1->middle_name != null) {
                    $name1 = "$value1->first_name " . strtoupper(strtolower($value1->middle_name[0])) . ". $value1->last_name";
                } else {
                    $name1 = "$value1->first_name $value1->last_name";
                }

                // value 2
                if ($i2 <= $applicant_count) {
                    $value2 = $applications[$i2 - 1];
                    if ($value2->middle_name != null) {
                        $name2 = "$value2->first_name " . strtoupper(strtolower($value2->middle_name[0])) . ". $value2->last_name";
                    } else {
                        $name2 = "$value2->first_name $value2->last_name";
                    }
                } else {
                    $i2 = "";
                    $name2 = "";
                }

                $templateProcessor->setValue("dno#$i", "$i.");
                $templateProcessor->setValue("dno_name#$i", $name1);
                $templateProcessor->setValue("dnt#$i", "$i2.");
                $templateProcessor->setValue("dnt_name#$i", $name2);
            }
        } else {
            $iteration = $applicant_count;
            $templateProcessor->cloneRow("dno", $iteration);

            foreach ($applications as $key => $value) {
                $i = $key + 1;
                if ($value->middle_name != null) {
                    $name = "$value->first_name " . strtoupper(strtolower($value->middle_name[0])) . ". $value->last_name $value->suffix";
                } else {
                    $name = "$value->first_name $value->last_name $value->suffix";
                }

                $templateProcessor->setValue("dno#$i", "$i.");
                $templateProcessor->setValue("dno_name#$i", $name);
                $templateProcessor->setValue("dnt#$i", "");
                $templateProcessor->setValue("dnt_name#$i", "");
            }
        }



        // process applications

        $permanents = Application::where([['shortlisted', 1], ['vacancy_id', $vacancy->id], ['application_type', 'Insider-Permanent']])->orderBy('last_name')->get();
        $casuals = Application::where([['shortlisted', 1], ['vacancy_id', $vacancy->id], ['application_type', 'Insider-Casual']])->orderBy('last_name')->get();
        $outsiders = Application::where([['shortlisted', 1], ['vacancy_id', $vacancy->id], ['application_type', 'Outsider']])->orderBy('last_name')->get();

        // max iteration

        $permanent_count = count($permanents);
        $casual_count = count($casuals);
        $outsider_count = count($outsiders);


        $iteration = max($permanent_count, $casual_count, $outsider_count);
        $templateProcessor->cloneRow("pn", $iteration);

        for ($x = 0; $x < $iteration; $x++) {

            $i = $x + 1;
            $i1 = "";
            $i2 = "";
            $i3 = "";

            $permanent_name = "";
            $casual_name = "";
            $outsider_name = "";

            if ($x < $permanent_count) {
                $permanent = $permanents[$x];
                $i1 = ($x + 1) . ".";
                if ($permanent->middle_name != null) {
                    $permanent_name = "$permanent->first_name " . strtoupper(strtolower($permanent->middle_name[0])) . ". $permanent->last_name";
                } else {
                    $permanent_name = "$permanent->first_name $permanent->last_name";
                }
            }

            if ($x < $casual_count) {
                $casual = $casuals[$x];
                $i2 = ($x + 1) . ".";
                if ($casual->middle_name != null) {
                    $casual_name = "$casual->first_name " . strtoupper(strtolower($casual->middle_name[0])) . ". $casual->last_name";
                } else {
                    $casual_name = "$casual->first_name $casual->last_name";
                }
            }

            if ($x < $outsider_count) {
                $outsider = $outsiders[$x];
                $i3 = ($x + 1) . ".";
                if ($outsider->middle_name != null) {
                    $outsider_name = "$outsider->first_name " . strtoupper(strtolower($outsider->middle_name[0])) . ". $outsider->last_name";
                } else {
                    $outsider_name = "$outsider->first_name $outsider->last_name";
                }
            }

            $templateProcessor->setValue("pn#$i", "$i1");
            $templateProcessor->setValue("permanent_name#$i", $permanent_name);
            $templateProcessor->setValue("cn#$i", "$i2");
            $templateProcessor->setValue("casual_name#$i", $casual_name);
            $templateProcessor->setValue("on#$i", "$i3");
            $templateProcessor->setValue("outsider_name#$i", $outsider_name);
        }


        $templateProcessor->saveAs($filePath);
        $fileContents = file_get_contents($filePath);
        $base64 = base64_encode($fileContents);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        return $this->success(compact('base64', 'filename'), 'Successfully Retrieved.', 200);
    }


    function generateNoticeToIndividuals(Vacancy $vacancy)
    {
        $lgu_position = $vacancy->lguPosition;
        $division = $lgu_position->division;
        $position = $lgu_position->position;
        $filename =  "$position->title - $lgu_position->item_number - Individual Notice";
        $filePath = public_path('\Word Results\\' . $filename . ".docx");

        $governor = Governor::latest()->first();
        $governor_name = $governor->prefix . " " . $governor->name . " " . $governor->suffix;
        $interview = Interview::find($vacancy->vacancyInterview->interview_id);

        $templateProcessor = new TemplateProcessor(public_path() . "\Word Templates\Notice-Individual.docx");
        //  replace value in the template
        $templateProcessor->setValue("date_created", date('F j, Y', strtotime($interview->date_created)));
        $templateProcessor->setValue("meeting_date", date('F j, Y', strtotime($interview->meeting_date)));
        $templateProcessor->setValue("position", $position->title);
        $templateProcessor->setValue("office", $division->division_name);
        $templateProcessor->setValue("day",  date('w', strtotime($interview->meeting_date)));
        $templateProcessor->setValue("venue", $interview->venue->name);
        $templateProcessor->setValue("governor", $governor_name);

        $applications = Application::where([['shortlisted', 1], ['vacancy_id', $vacancy->id]])->orderBy('last_name')->get();
        $applicant_count = count($applications);


        // process applications
        $permanents = Application::where([['shortlisted', 1], ['vacancy_id', $vacancy->id], ['application_type', 'Insider-Permanent']])->orderBy('last_name')->get();
        $casuals = Application::where([['shortlisted', 1], ['vacancy_id', $vacancy->id], ['application_type', 'Insider-Casual']])->orderBy('last_name')->get();
        $outsiders = Application::where([['shortlisted', 1], ['vacancy_id', $vacancy->id], ['application_type', 'Outsider']])->orderBy('last_name')->get();

        // max iteration
        $permanent_count = count($permanents);
        $casual_count = count($casuals);
        $outsider_count = count($outsiders);


        $iteration = max($permanent_count, $casual_count, $outsider_count);
        $templateProcessor->cloneRow("pn", $iteration);

        for ($x = 0; $x < $iteration; $x++) {

            $i = $x + 1;
            $i1 = "";
            $i2 = "";
            $i3 = "";

            $permanent_name = "";
            $casual_name = "";
            $outsider_name = "";

            if ($x < $permanent_count) {
                $permanent = $permanents[$x];
                $i1 = ($x + 1) . ".";
                if ($permanent->middle_name != null) {
                    $permanent_name = "$permanent->first_name " . strtoupper(strtolower($permanent->middle_name[0])) . ". $permanent->last_name";
                } else {
                    $permanent_name = "$permanent->first_name $permanent->last_name";
                }
            }

            if ($x < $casual_count) {
                $casual = $casuals[$x];
                $i2 = ($x + 1) . ".";
                if ($casual->middle_name != null) {
                    $casual_name = "$casual->first_name " . strtoupper(strtolower($casual->middle_name[0])) . ". $casual->last_name";
                } else {
                    $casual_name = "$casual->first_name $casual->last_name";
                }
            }

            if ($x < $outsider_count) {
                $outsider = $outsiders[$x];
                $i3 = ($x + 1) . ".";
                if ($outsider->middle_name != null) {
                    $outsider_name = "$outsider->first_name " . strtoupper(strtolower($outsider->middle_name[0])) . ". $outsider->last_name";
                } else {
                    $outsider_name = "$outsider->first_name $outsider->last_name";
                }
            }

            $templateProcessor->setValue("pn#$i", "$i1");
            $templateProcessor->setValue("permanent_name#$i", $permanent_name);
            $templateProcessor->setValue("cn#$i", "$i2");
            $templateProcessor->setValue("casual_name#$i", $casual_name);
            $templateProcessor->setValue("on#$i", "$i3");
            $templateProcessor->setValue("outsider_name#$i", $outsider_name);
        }


        // clone block
        $templateProcessor->cloneblock("block", $applicant_count, true, true);
        foreach ($applications as $key => $value) {
            $i = $key + 1;
            if ($value->middle_name != null) {
                $name = "$value->first_name " . strtoupper(strtolower($value->middle_name[0])) . ". $value->last_name $value->suffix";
            } else {
                $name = "$value->first_name $value->last_name $value->suffix";
            }

            $personal_information = Application::find($value->id)->individual->latestPersonalDataSheet->personalInformation;

            $address = "$personal_information->permanent_house $personal_information->permanent_barangay, $personal_information->permanent_municipality, $personal_information->permanent_province";

            $templateProcessor->setValue("name#$i", strtoupper(strtolower($name)));
            $templateProcessor->setValue("address#$i", ucwords(strtolower($address)));
            $templateProcessor->setValue("mobile_number#$i", $personal_information->mobile_number);
        }



        $templateProcessor->saveAs($filePath);
        $fileContents = file_get_contents($filePath);
        $base64 = base64_encode($fileContents);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        return $this->success(compact('base64', 'filename'), 'Successfully Retrieved.', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }
}
