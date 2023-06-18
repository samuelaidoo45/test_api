<?php

namespace App\Http\Controllers;

use App\Models\XRay;
use Illuminate\Http\Request;

class XRayController extends Controller
{
    // create index function
    public function index()
    {
        // return all xrays
        return XRay::all();
    }


    // create store function
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'name' => 'required',
        ]);

        // create new xray
        $xray = new XRay;

        // set xray id
        // generate unsigned big integer unique id
        $xray->xray_id = XRay::max('xray_id') + 1;

        // set xray name
        $xray->name = $request->name;

        // save new xray
        $xray->save();

        // return xray
        return $xray;
    }

    
}
