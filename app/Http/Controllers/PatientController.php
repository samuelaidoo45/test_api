<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //create index function
    public function index()
    {
        //return all patients
        return Patient::all();
    }

    //create show function
    public function show(Patient $patient)
    {
        //return single patient
        return $patient;
    }

    //create store function
    public function store(Request $request)
    {
        //create new patient
        $patient = new Patient;

        //set patient id
        //generate unsigned big integer unique id
        $patient->patient_id = Patient::max('patient_id') + 1;

        //set patient name
        $patient->name = $request->name;

        //save new patient
        $patient->save();

        //return patient
        return $patient;
    }

    //create update function
    public function update(Request $request, Patient $patient)
    {
        //set new patient name
        $patient->name = $request->name;

        //save updated patient
        $patient->save();

        //return updated patient
        return $patient;
    }

    //create destroy function
    public function destroy(Patient $patient)
    {
        //delete patient
        $patient->delete();

        //return response
        return response()->json([
            'message' => 'patient deleted'
        ]);
    }
    

}
