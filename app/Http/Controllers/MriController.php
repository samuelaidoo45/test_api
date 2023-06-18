<?php

namespace App\Http\Controllers;

use App\Models\Mri;
use Illuminate\Http\Request;

class MriController extends Controller
{
    // create index function
    public function index()
    {
        // return all mris
        return Mri::all();
    }

    // create show function
    public function show(Mri $mri)
    {
        // return single mri
        return $mri;
    }

    // create store function
    public function store(Request $request)
    {
        // create new mri
        $mri = new Mri;

        // set mri id
        // generate unsigned big integer unique id
        $mri->mri_id = Mri::max('mri_id') + 1;

        // set mri name
        $mri->name = $request->name;

        // save new mri
        $mri->save();

        // return mri
        return $mri;
    }
}
