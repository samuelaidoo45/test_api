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
    // Route::get('/x-rays/{xray}', [XRayController::class, 'show']);
    Route::post('/x-rays', [XRayController::class, 'store']);
    // Route::put('/x-rays/{xray}', [XRayController::class, 'update']);

    //ultrasound
    Route::get('/ultrasounds', [UltrasoundController::class, 'index']);
    // Route::get('/ultrasounds/{ultrasound}', [UltrasoundController::class, 'show']);
    Route::post('/ultrasounds', [UltrasoundController::class, 'store']);
    // Route::put('/ultrasounds/{ultrasound}', [UltrasoundController::class, 'update']);

    //ctscan
    Route::get('/ctscans', [CtscanController::class, 'index']);
    // Route::get('/ctscans/{ctscan}', [CtscanController::class, 'show']);
    Route::post('/ctscans', [CtscanController::class, 'store']);
    // Route::put('/ctscans/{ctscan}', [CtscanController::class, 'update']);

    //mri
    Route::get('/mris', [MriController::class, 'index']);
    // Route::get('/mris/{mri}', [MriController::class, 'show']);
    Route::post('/mris', [MriController::class, 'store']);
    // Route::put('/mris/{mri}', [MriController::class, 'update']);

    //medical record
    //Route::get('/medical-records', [MedicalRecordController::class, 'index']);
    // Route::get('/medical-records/{medical_record}', [MedicalRecordController::class, 'show']);
    Route::post('/medical-records', [MedicalRecordController::class, 'store']);
    // Route::put('/medical-records/{medical_record}', [MedicalRecordController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
