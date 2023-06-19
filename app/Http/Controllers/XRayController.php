<?php

namespace App\Http\Controllers;

use App\Models\XRay;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;




class XRayController extends Controller
{
    // create index function

        public function index()
        {
            try {
                // Return all xrays
                $xrays = XRay::all();

                return response()->json([
                    'xrays' => $xrays,
                ], 200);
            } catch (ModelNotFoundException $e) {
                // Handle model not found exception
                return response()->json([
                    'error' => 'X-Rays not found.',
                ], Response::HTTP_NOT_FOUND);
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
    
            // Create new xray
            $xray = new XRay;
    
            // Set xray id
            // Generate unsigned big integer unique id
            $xray->xray_id = XRay::max('xray_id') + 1;
    
            // Set xray name
            $xray->name = $validatedData['name'];
    
            // Save new xray
            $xray->save();
    
            // Return success response
            return response()->json([
                'message' => 'XRay created successfully',
                'xray' => $xray
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
