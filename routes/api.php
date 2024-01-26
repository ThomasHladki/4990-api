<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//protected/authenticated routes
//Needs to be logged in, pass bearer token authorization for all requests below

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/getProfile', [AuthController::class, 'retrieveProfileFromUser']);     //Once user is logged in, get their corresponding doctor or student info, or if none, prompt to create
    

});