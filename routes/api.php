<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//All requests need headers Content-Type = application/vnd.api+json and Accept = application/vnd.api+json
//Local testing: The url will be like localhost:8000/api/{route}

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public routes
//Doesn't require token to be passed

Route::get('/test', [AuthController::class, 'test']); 
Route::get('/test2', [AuthController::class, 'test2']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//protected/authenticated routes
//Needs to be logged in, pass bearer token authorization for all requests below

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getProfile', [AuthController::class, 'retrieveProfileFromUser']);     //Once user is logged in, get their corresponding doctor or student info, or if none, prompt to create
    
    //Students
    Route::get('/student', [StudentController::class, 'getStudent']);
    Route::post('/student/create', [StudentController::class, 'createStudent']);
    Route::get('/educational/get', [StudentController::class, 'getEducationalInstitutions']);
    Route::patch('/student/update', [StudentController::class, 'updateStudent']);
    Route::get('/student/grades', [StudentController::class, 'getGrades']);
    Route::get('/student/matches', [StudentController::class, 'getMatches']);
    Route::post('/student/grade/create', [StudentController::class, 'createStudentGrade']);
    Route::delete('/student/grade/delete', [StudentController::class, 'deleteStudentGrade']);
    Route::post('/student/create/location/preference', [StudentController::class, 'createOrUpdateLocationPreference']);
    Route::delete('/student/create/location/preference/delete', [StudentController::class, 'deleteLocationPreference']);
    Route::get('/student/applications/all', [StudentController::class, 'getAllApplications']);
    Route::get('/student/application', [StudentController::class, 'getApplication']);
    Route::post('/student/apply', [StudentController::class, 'applyForPosition']);


    //Doctors
    Route::get('/doctor', [DoctorController::class, 'getDoctor']);
    Route::post('/doctor/create', [DoctorController::class, 'createDoctor']);
    Route::get('/medical_institutions', [DoctorController::class, 'getMedicalInstitutions']);
    Route::post('/medical_institution/create', [DoctorController::class, 'createMedicalInstitution']);
    Route::patch('/doctor/update', [DoctorController::class, 'updateDoctor']);
    Route::get('/doctor/positions/all', [DoctorController::class, 'viewResidencyPositions']);
    Route::get('/doctor/position/applications', [DoctorController::class, 'viewApplicationsForPosition']);
    Route::get('/doctor/applications', [DoctorController::class, 'viewAllApplications']);
    Route::post('/doctor/position/create', [DoctorController::class, 'createResidencyPosition']);
    Route::get('/doctor/position/grades', [DoctorController::class, 'viewPositionGrades']);
    Route::post('/doctor/position/grade/create', [DoctorController::class, 'createResidencyPositionGrade']);
    Route::delete('/doctor/position/grade/delete', [DoctorController::class, 'deletePositionGrade']);
    Route::patch('/doctor/position/update', [DoctorController::class, 'updateResidencyPosition']);
    Route::post('/doctor/position/close', [DoctorController::class, 'closePosition']);
    Route::post('/doctor/position/open', [DoctorController::class, 'openPosition']);
    Route::post('/doctor/application/reject', [DoctorController::class, 'rejectApplicant']);
    Route::post('/doctor/application/accept', [DoctorController::class, 'acceptApplicant']);
});