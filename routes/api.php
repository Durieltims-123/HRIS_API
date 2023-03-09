<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\SalaryGradeController;
use App\Models\SalaryGrade;
use App\Http\Controllers\PositionController;
// use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/test', [AuthController::class, 'test']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/holidays', HolidaysController::class);

    // Route::post('/salary-grade', [SalaryGradeController::class, 'store']);
    // Route::get('/show-salary-grade', [SalaryGradeController::class, 'index']);
    // Route::update('/update-salary-grade', [SalaryGradeController::class, 'update']);
    // Route::delete('',[SalaryGradeController::class, 'delete']);

    Route::resource('/salaryGrade',SalaryGradeController::class);

    Route::resource('/position',PositionController::class);

    Route::resource('/qualificationStandard',QuaificationStandardController::class);
    
    Route::resource('/plantilla',PlantillaController::class);

    Route::resource('/office',OfficeController::class);

    Route::resource('/positionDescription',PositionDescriptionController::class);

    Route::resource('/vacancy',VacancyController::class);

    Route::resource('/province',ProvinceController::class);

    Route::resource('/municipality',MunicipalityController::class);

    Route::resource('/barangay',BarangayController::class);
    
});
