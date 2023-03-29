<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\PsbMemberController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SalaryGradeController;
use App\Http\Controllers\PersonalDataSheetController;
use App\Http\Controllers\PositionDescriptionController;
use App\Http\Controllers\QualificationStandardController;
use App\Http\Controllers\PersonnelSelectionBoardController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/holidays', HolidaysController::class);


    //alfy
    Route::resource('/salary-grade', SalaryGradeController::class);
    Route::resource('/position', PositionController::class);
    Route::post('/search-position', [PositionController::class, 'search']);
    Route::post('/search-office', [OfficeController::class, 'search']);
    Route::resource('/office', OfficeController::class);
    Route::resource('/position-description', PositionDescriptionController::class);
    Route::resource('/qualification-standard', QualificationStandardController::class);
    Route::resource('/personal-data-sheet', PersonalDataSheetController::class);
    Route::resource('/province', ProvinceController::class);

    //Qnan
    Route::resource('/personnel-selection-board', PersonnelSelectionBoardController::class);
    Route::resource('/psb-member', PsbMemberController::class);
    Route::resource('/assessment', AssessmentController::class);
    Route::resource('/vacancy', VacancyController::class);
    Route::resource('/plantilla', PlantillaController::class);
    Route::resource('/department', DepartmentController::class);
});
