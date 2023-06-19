<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Validator;

use App\Models\MedicalRecord;
use App\Models\MedicalRecordXrayOption;
use App\Models\MedicalRecordUltrasoundOption;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;





final class StoreMedicalRecord
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */

    public function __invoke($_, array $args): JsonResponse
    {
        try {
            $request = $args['medical_record'];

            // validate the input data
            $validator = Validator::make($args['medical_record'], [
                'patient_id' => 'required',
                'ctscan_id' => 'required',
                'mri_id' => 'required',
                'xrays' => 'required',
                'ultrasounds' => 'required'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $request = (object) $request;

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

            // batch insert xray options
            $medical_record_xray_options = [];
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

            // batch insert ultrasound options
            $medical_record_ultrasound_options = [];
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

            $medical_record->save();

            Mail::to('peopleoperations@kompletecare.com')->send(new WelcomeEmail($request));

            // Return response with status code and message
            return response()->json([
                'status' => 200,
                'message' => 'Medical record created successfully',
                'medical_record' => $medical_record,
                'medical_record_xray_options' => $medical_record_xray_options,
                'medical_record_ultrasound_options' => $medical_record_ultrasound_options
            ], 200);
        } catch (ValidationException $exception) {
            // Handle validation errors
            $errors = $exception->validator->errors()->all();
            return response()->json([
                'status' => 422,
                'error' => 'Validation failed',
                'errors' => $errors
            ], 422);
        } catch (\Exception $exception) {
            // Handle other exceptions
            Log::error($exception);
            return response()->json([
                'status' => 500,
                'error' => 'Internal server error',
            ], 500);
        }
    }

}
