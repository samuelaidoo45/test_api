<?php

namespace App\Http\Controllers;

use App\Models\Ctscan;
use Illuminate\Http\Request;

class CtscanController extends Controller
{
    // create index function
    public function index()
    {
        // return all ctscans
        return Ctscan::all();
    }

    // create show function
    public function show(Ctscan $ctscan)
    {
        // return single ctscan
        return $ctscan;
    }

    // create store function
    public function store(Request $request)
    {
        // create new ctscan
        $ctscan = new Ctscan;

        // set ctscan id
        // generate unsigned big integer unique id
        $ctscan->ctscan_id = Ctscan::max('ctscan_id') + 1;

        // set ctscan name
        $ctscan->name = $request->name;

        // save new ctscan
        $ctscan->save();

        // return ctscan
        return $ctscan;
    }
}
