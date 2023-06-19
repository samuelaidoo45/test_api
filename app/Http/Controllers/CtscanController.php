<?php

namespace App\Http\Controllers;

use App\Models\Ctscan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;


class CtscanController extends Controller
{
       
    public function index()
    {
        try {
            // Retrieve all CT scans
            $ctscans = Ctscan::all();
    
            return response()->json([
                'ctscans' => $ctscans,
            ], 200);
        } catch (QueryException $e) {
            // Handle database query exception
            return response()->json([
                'error' => 'Failed to retrieve CT scans from the database.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'error' => 'Internal server error.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    public function store(Request $request)
    {
        try {
            // validate request
            $request->validate([
                'name' => 'required',
            ]);

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
            return response()->json([
                'message' => 'Ctscan created successfully',
                'ctscan' => $ctscan
            ], 201);
        } catch (QueryException $e) {
            // Handle database query exception
            return response()->json([
                'error' => 'Failed to create CT scan.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'error' => 'Internal server error.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
