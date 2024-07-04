<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\LguPositionController;
use App\Http\Controllers\PsbMemberController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OathTakingController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\SalaryGradeController;
use App\Http\Controllers\DisqualificationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GovernorController;
use App\Http\Controllers\OrientationController;
use App\Http\Controllers\PersonalDataSheetController;
use App\Http\Controllers\PositionDescriptionController;
use App\Http\Controllers\ReportOfAppointmentController;
use App\Http\Controllers\QualificationStandardController;
use App\Http\Controllers\PersonnelSelectionBoardController;
use App\Http\Controllers\ServiceRecordFormController;
use App\Http\Controllers\UserController;


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
    Route::post('/search-holidays', [HolidaysController::class, 'search']);

    Route::resource('/users', UserController::class);
    Route::post('/search-users', [UserController::class, 'search']);

    Route::resource('/governors', GovernorController::class);
    Route::post('/search-governors', [GovernorController::class, 'search']);



    Route::resource('/salary-grade', SalaryGradeController::class);
    Route::post('/search-salary-grade', [SalaryGradeController::class, 'search']);

    Route::resource('/position', PositionController::class);
    Route::post('/search-position', [PositionController::class, 'search']);
    Route::post('/search-office', [OfficeController::class, 'search']);
    Route::post('/search-division', [DivisionController::class, 'search']);
    Route::resource('/division', DivisionController::class);
    Route::resource('/position-description', PositionDescriptionController::class);
    Route::resource('/qualification-standard', QualificationStandardController::class);
    Route::resource('/personal-data-sheet', PersonalDataSheetController::class);
    Route::resource('/province', ProvinceController::class);
    Route::resource('/applicant', ApplicantController::class);
    Route::post('/search-applicant', [ApplicantController::class, 'search']);

    Route::resource('/employee', EmployeeController::class);
    Route::post('/search-employee', [EmployeeController::class, 'search']);
    Route::post('/employee-validation', [EmployeeController::class, 'validation']);


    Route::post('/search-cos', [EmployeeController::class, 'searchCos']);
    Route::resource('/question', QuestionController::class);
    Route::resource('/service-record-form', ServiceRecordFormController::class);
    Route::resource('/orientation', OrientationController::class);

    //Qnan
    Route::resource('/personnel-selection-board', PersonnelSelectionBoardController::class);
    Route::resource('/psb-member', PsbMemberController::class);
    Route::resource('/assessment', AssessmentController::class);
    Route::resource('/vacancy', VacancyController::class);
    Route::post('/search-vacancy', [VacancyController::class, 'search']);

    Route::post('/search-closing-date', [PublicationController::class, 'searchClosingDate']);
    Route::post('/search-lgu-position', [LguPositionController::class, 'search']);
    Route::resource('/lgu-position', LguPositionController::class);
    Route::resource('/office', OfficeController::class);
    Route::resource('/publication', PublicationController::class);
    Route::resource('/application', ApplicationController::class);
    Route::post('/search-person', [ApplicationController::class, 'searchPerson']);
    Route::post('/search-applications', [ApplicationController::class, 'search']);
    Route::post('/view-application-attachments', [ApplicationController::class, 'viewAttachments']);
    Route::post('/disqualify-application/{application}', [ApplicationController::class, 'disqualify']);
    Route::post('/shortlist-application/{application}', [ApplicationController::class, 'shortlist']);
    Route::post('/revert-application/{application}', [ApplicationController::class, 'revert']);
    Route::get('/download-disqualification-letter/{application}', [ApplicationController::class, 'downloadLetterOfDisqualification']);
    Route::post('/send-disqualification-email/{application}', [EmailController::class, 'sendDisqualificationEmail']);


    Route::resource('/disqualification', DisqualificationController::class);
    Route::get('/disqualification-reverse/{disqualification}', [DisqualificationController::class, 'reverseDisqualification']);
    Route::resource('/notice', NoticeController::class);
    Route::resource('/interview', InterviewController::class);
    Route::resource('/appointment', AppointmentController::class);
    Route::resource('/oathtaking', OathTakingController::class);
    Route::resource('/report-of-appointment', ReportOfAppointmentController::class);
});
