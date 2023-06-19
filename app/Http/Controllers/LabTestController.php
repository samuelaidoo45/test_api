<?php


namespace App\Http\Controllers;

use App\Models\XRay;
use App\Models\Mri;
use App\Models\Ultrasound;
use App\Models\Ctscan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class LabTestController extends Controller
{
    public function lab_test()
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
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'error' => 'Failed to retrieve lab test components.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
