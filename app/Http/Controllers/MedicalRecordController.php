<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // create new medical record
        $medical_record = new MedicalRecord;

        // set medical record id
        // generate unsigned big integer unique id
        $medical_record->medical_record_id = MedicalRecord::max('medical_record_id') + 1;

        // set medical record name
        $medical_record->name = $request->name;

        // save new medical record
        $medical_record->save();

        // return medical record
        return $medical_record;
    }
}
