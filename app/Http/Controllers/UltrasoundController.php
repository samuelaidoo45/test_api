<?php

namespace App\Http\Controllers;

use App\Models\Ultrasound;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UltrasoundController extends Controller
{
    
    public function index()
    {
        try {
            // Return all ultrasounds
            $ultrasounds = Ultrasound::all();
    
            return response()->json([
                'ultrasounds' => $ultrasounds,
            ], 200);
        } catch (QueryException $e) {
            // Handle database query exception
            return response()->json([
                'error' => 'Failed to retrieve ultrasounds from the database.',
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
            $validatedData = $request->validate([
                'name' => 'required',
            ]);
    
            // Create new ultrasound
            $ultrasound = new Ultrasound;
    
            // Set ultrasound id
            // Generate unsigned big integer unique id
            $ultrasound->ultrasound_id = Ultrasound::max('ultrasound_id') + 1;
    
            // Set ultrasound name
            $ultrasound->name = $validatedData['name'];
    
            // Save new ultrasound
            $ultrasound->save();
    
            // Return success response
            return response()->json([
                'message' => 'Ultrasound created successfully',
                'ultrasound' => $ultrasound
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
