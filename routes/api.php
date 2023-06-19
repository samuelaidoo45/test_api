<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\XRayController;
use App\Http\Controllers\UltrasoundController;
use App\Http\Controllers\CtscanController;
use App\Http\Controllers\MriController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\LabTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\GraphQL\Queries\LabTestQuery;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/generate-token', [TokenController::class, 'generateToken']);


Route::middleware('auth:sanctum')->group(function () {


    //lab_test
    Route::get('/lab-tests', [LabTestController::class, 'lab_test']);

    //patient
    //Route::get('/patients', [PatientController::class, 'index']);
    // Route::get('/patients/{patient}', [PatientController::class, 'show']);
    //Route::post('/patients', [PatientController::class, 'store']);
    // Route::put('/patients/{patient}', [PatientController::class, 'update']);

    //xray
    Route::get('/x-rays', [XRayController::class, 'index']);
    Route::post('/x-rays', [XRayController::class, 'store']);

    //ultrasound
    Route::get('/ultrasounds', [UltrasoundController::class, 'index']);
    Route::post('/ultrasounds', [UltrasoundController::class, 'store']);

    //ctscan
    Route::get('/ctscans', [CtscanController::class, 'index']);
    Route::post('/ctscans', [CtscanController::class, 'store']);

    //mri
    Route::get('/mris', [MriController::class, 'index']);
    Route::post('/mris', [MriController::class, 'store']);


    //medical record
    Route::post('/medical-records', [MedicalRecordController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

