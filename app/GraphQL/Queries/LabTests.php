<?php

namespace App\GraphQL\Queries;

use App\Models\Ctscan;
use App\Models\Mri;
use App\Models\Ultrasound;
use App\Models\XRay;

final class LabTests
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver

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
