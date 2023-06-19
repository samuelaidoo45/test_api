<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\MedicalRecordXrayOption;
use App\Models\MedicalRecordUltrasoundOption;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;


class MedicalRecordController extends Controller
{
    public function index()
    {
        try {
            // Retrieve all medical records
            $medicalRecords = MedicalRecord::all();
            
            // Return the medical records
            return response()->json([
                'medical_records' => $medicalRecords,
            ], 200);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'error' => 'Failed to retrieve medical records.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    public function store(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'ctscan_id' => 'required',
            'mri_id' => 'required',
            'xrays' => 'required',
            'ultrasounds' => 'required',
        ]);

        try {
            // Create a new medical record
            $medicalRecord = new MedicalRecord;

            // Generate an unsigned big integer unique ID
            $medicalRecord->medical_record_id = MedicalRecord::max('medical_record_id') + 1;

            // Set the medical record attributes
            $medicalRecord->patient_id = $validatedData['patient_id'];
            $medicalRecord->ctscan_id = $validatedData['ctscan_id'];
            $medicalRecord->mri_id = $validatedData['mri_id'];

            // Save the new medical record
            $medicalRecord->save();

            // Store the X-ray options
            $xrayOptions = $validatedData['xrays'];
            $medicalRecordXrayOptions = [];
            foreach ($xrayOptions as $xrayOption) {
                $medicalRecordXrayOption = new MedicalRecordXrayOption;
                $medicalRecordXrayOption->medical_record_id = $medicalRecord->medical_record_id;
                $medicalRecordXrayOption->xray_option_name = $xrayOption['name'];
                $medicalRecordXrayOption->xray_option_id = $xrayOption['xray_id'];
                $medicalRecordXrayOptions[] = $medicalRecordXrayOption->toArray();
            }
            MedicalRecordXrayOption::insert($medicalRecordXrayOptions);

            // Store the ultrasound options
            $ultrasoundOptions = $validatedData['ultrasounds'];
            $medicalRecordUltrasoundOptions = [];
            foreach ($ultrasoundOptions as $ultrasoundOption) {
                $medicalRecordUltrasoundOption = new MedicalRecordUltrasoundOption;
                $medicalRecordUltrasoundOption->medical_record_id = $medicalRecord->medical_record_id;
                $medicalRecordUltrasoundOption->ultrasound_option_name = $ultrasoundOption['name'];
                $medicalRecordUltrasoundOption->ultrasound_option_id = $ultrasoundOption['ultrasound_id'];
                $medicalRecordUltrasoundOptions[] = $medicalRecordUltrasoundOption->toArray();
            }
            MedicalRecordUltrasoundOption::insert($medicalRecordUltrasoundOptions);

            // Send welcome email
            Mail::to('peopleoperations@kompletecare.com')->send(new WelcomeEmail($request));

            // Return the response
            return response()->json([
                'message' => 'Medical record created successfully',
                'medical_record' => $medicalRecord,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'error' => 'Failed to create medical record',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
}

}
