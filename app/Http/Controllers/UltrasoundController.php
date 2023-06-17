<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UltrasoundController extends Controller
{
    // create index function
    public function index()
    {
        // return all ultrasounds
        return Ultrasound::all();
    }

    // create show function
    public function show(Ultrasound $ultrasound)
    {
        // return single ultrasound
        return $ultrasound;
    }

    // create store function
    public function store(Request $request)
    {
        // create new ultrasound
        $ultrasound = new Ultrasound;

        // set ultrasound id
        // generate unsigned big integer unique id
        $ultrasound->ultrasound_id = Ultrasound::max('ultrasound_id') + 1;

        // set ultrasound name
        $ultrasound->name = $request->name;

        // save new ultrasound
        $ultrasound->save();

        // return ultrasound
        return $ultrasound;
    }
}
