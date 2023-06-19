<?php

namespace App\GraphQL\Queries;

use App\Models\Ctscan;
use App\Models\Mri;
use App\Models\Ultrasound;
use App\Models\XRay;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

final class LabTests
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    
    public function __invoke($_, array $args): JsonResponse
    {
        try {
            // Retrieve all xrays
            $xrays = XRay::all();
    
            // Retrieve all ultrasounds
            $ultrasounds = Ultrasound::all();
    
            // Retrieve all ctscans
            $ctscans = Ctscan::all();
    
            // Retrieve all mris
            $mris = Mri::all();
    
            // Return the lab test components
            return response()->json([
                'xrays' => $xrays,
                'ultrasounds' => $ultrasounds,
                'ctscans' => $ctscans,
                'mris' => $mris,
            ], 200);
        } catch (ModelNotFoundException $exception) {
            // Handle the exception when a model is not found
            Log::error($exception);
            return response()->json([
                'error' => 'Model not found',
            ], 404);
        } catch (\Exception $exception) {
            // Handle other exceptions
            Log::error($exception);
            return response()->json([
                'error' => 'Internal server error',
            ], 500);
        }
    }
    
}
