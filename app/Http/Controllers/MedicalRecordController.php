<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\MedicalRecordXrayOption;
use App\Models\MedicalRecordUltrasoundOption;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class MedicalRecordController extends Controller
{
    //  create index function
    public function index()
    {
        // return all medical records
        return MedicalRecord::all();
    }

    // create show function
    public function show(MedicalRecord $medical_record)
    {
        // return single medical record
        return $medical_record;
    }

    // create store function
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'patient_id' => 'required',
            'ctscan_id' => 'required',
            'mri_id' => 'required',
            'xrays' => 'required',
            'ultrasounds' => 'required'
        ]);

        // create new medical record
        $medical_record = new MedicalRecord;
        $medical_record_xray_option = new MedicalRecordXrayOption;
        $medical_record_ultrasound_option = new MedicalRecordUltrasoundOption;

        // set medical record id
        // generate unsigned big integer unique id
        $medical_record->medical_record_id = MedicalRecord::max('medical_record_id') + 1;

        // set medical record name
        $medical_record->patient_id = $request->patient_id;
        $medical_record->ctscan_id = $request->ctscan_id;
        $medical_record->mri_id = $request->mri_id;

        $xraysoptions = $request->xrays;
        $ultrasoundsoptions = $request->ultrasounds;

        $medical_record_xray_options = [];

        // loop through xray options
        foreach ($xraysoptions as $xraysoption) {
            $xraysoption = (object) $xraysoption;
            // set medical record id
            $medical_record_xray_option->medical_record_id = $medical_record->medical_record_id;
            // set xray id
            $medical_record_xray_option->xray_option_name = $xraysoption->name;
            $medical_record_xray_option->xray_option_id = $xraysoption->xray_id;

            // save new medical record xray option
            $medical_record_xray_options[] = $medical_record_xray_option->toArray();

        }

        $medical_record_ultrasound_options = [];
        // loop through ultrasound options
        foreach ($ultrasoundsoptions as $ultrasoundsoption) {
            $ultrasoundsoption = (object) $ultrasoundsoption;
            // set medical record id
            $medical_record_ultrasound_option->medical_record_id = $medical_record->medical_record_id;
            // set ultrasound id
            $medical_record_ultrasound_option->ultrasound_option_name = $ultrasoundsoption->name;
            $medical_record_ultrasound_option->ultrasound_option_id = $ultrasoundsoption->ultrasound_id;

            // save new medical record ultrasound option
            $medical_record_ultrasound_options[] = $medical_record_ultrasound_option->toArray();
        }


        MedicalRecordXrayOption::insert($medical_record_xray_options);
        MedicalRecordUltrasoundOption::insert($medical_record_ultrasound_options);

        // save new medical record
        $medical_record->save();

        Mail::to('samuelaidoo45@gmail.com')->send(new WelcomeEmail($request));

        return response()->json([
            'message' => 'Medical record created successfully',
            'medical_record' => $medical_record
        ], 201);
    }
}
