<?php


namespace App\Http\Controllers;

use App\Models\XRay;
use App\Models\Mri;
use App\Models\Ultrasound;
use App\Models\Ctscan;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    //get all the component of lab test
    public function lab_test()
    {
        // return all xrays
        $xrays = XRay::all();
        // return all ultrasounds
        $ultrasounds = Ultrasound::all();
        // return all ctscans
        $ctscans = Ctscan::all();
        // return all mris
        $mris = Mri::all();

        // return all lab test components

        return response()->json([
            'xrays' => $xrays,
            'ultrasounds' => $ultrasounds,
            'ctscans' => $ctscans,
            'mris' => $mris,
        ], 200);
    }
}
