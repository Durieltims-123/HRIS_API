<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\PsbMemberController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OathTakingController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\SalaryGradeController;
use App\Http\Controllers\DisqualificationController;
use App\Http\Controllers\OrientationController;
use App\Http\Controllers\PersonalDataSheetController;
use App\Http\Controllers\PositionDescriptionController;
use App\Http\Controllers\ReportOfAppointmentController;
use App\Http\Controllers\QualificationStandardController;
use App\Http\Controllers\PersonnelSelectionBoardController;
use App\Http\Controllers\ServiceRecordFormController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::get('/test', [AuthController::class, 'testing']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/holidays', HolidaysController::class);


    //alfy
    Route::resource('/salary-grade', SalaryGradeController::class);
    Route::post('/search-salary-grade', [SalaryGradeController::class, 'search']);

    Route::resource('/position', PositionController::class);
    Route::post('/search-position', [PositionController::class, 'search']);
    Route::post('/search-office', [OfficeController::class, 'search']);
    Route::resource('/office', OfficeController::class);
    Route::resource('/position-description', PositionDescriptionController::class);
    Route::resource('/qualification-standard', QualificationStandardController::class);
    Route::resource('/personal-data-sheet', PersonalDataSheetController::class);
    Route::resource('/province', ProvinceController::class);
    Route::resource('/applicant', ApplicantController::class);
    Route::resource('/employee', EmployeeController::class);
    Route::resource('/question', QuestionController::class);
    Route::resource('/service-record-form', ServiceRecordFormController::class);
    Route::resource('/orientation', OrientationController::class);

    //Qnan
    Route::resource('/personnel-selection-board', PersonnelSelectionBoardController::class);
    Route::resource('/psb-member', PsbMemberController::class);
    Route::resource('/assessment', AssessmentController::class);
    Route::resource('/vacancy', VacancyController::class);
    Route::get('/vacancy-queue/{vacancy}', [VacancyController::class, 'vacancyQueue']);
    Route::get('/vacancy-all-approved', [VacancyController::class, 'allApproved']);
    Route::get('/vacancy-all-queued', [VacancyController::class, 'allQueued']);

    Route::post('/search-closing-date', [PublicationController::class, 'searchClosingDate']);
    Route::resource('/plantilla', PlantillaController::class);
    Route::resource('/department', DepartmentController::class);
    Route::resource('/publication', PublicationController::class);
    Route::resource('/application', ApplicationController::class);
    Route::resource('/disqualification', DisqualificationController::class);
    Route::get('/disqualification-reverse/{disqualification}', [DisqualificationController::class, 'reverseDisqualification']);
    Route::resource('/notice', NoticeController::class);
    Route::resource('/interview', InterviewController::class);
    Route::resource('/appointment', AppointmentController::class);
    Route::resource('/oathtaking', OathTakingController::class);
    Route::resource('/report-of-appointment', ReportOfAppointmentController::class);
});
