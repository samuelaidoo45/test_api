<?php

namespace App\Http\Controllers;

use App\Models\Mri;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class MriController extends Controller
{

    public function index()
    {
        try {
            // Retrieve all MRIs
            $mris = Mri::all();

            return response()->json([
                'mris' => $mris,
            ], 200);
        } catch (QueryException $e) {
            // Handle database query exception
            return response()->json([
                'error' => 'Failed to retrieve MRIs from the database.',
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
            // Validate request
            $request->validate([
                'name' => 'required',
            ]);

            // Create new MRI
            $mri = new Mri;

            // Set MRI id
            // Generate unsigned big integer unique id
            $mri->mri_id = Mri::max('mri_id') + 1;

            // Set MRI name
            $mri->name = $request->name;

            // Save new MRI
            $mri->save();

            // Return success response
            return response()->json([
                'message' => 'MRI created successfully',
                'mri' => $mri
            ], Response::HTTP_CREATED);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'error' => $e->errors(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'error' => 'Internal server error.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
