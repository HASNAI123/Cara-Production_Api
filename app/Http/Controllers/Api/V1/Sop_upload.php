<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class Sop_upload extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploaded_by' => 'required|string',
            'sop_title' => 'required|string',
            'business_unit' => 'required|string',
            'sop_file' => 'string', // Allow a string (single file)
            'archive_folder' => 'required|integer', // Archive folder ID as an integer
            'Division' =>'string',
            'Document_Category' => 'string',
            'Reviewed_Year' => ''
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $sop = new Sop;

        $sop->uploaded_by = $request->uploaded_by;
        $sop->sop_title = $request->sop_title;
        $sop->business_unit = $request->business_unit;
        $sop->archive_folder = $request->archive_folder; // Assign the archive_folder ID

        // Assign the additional parameters
        $sop->Division = $request->input('Division', null); // Default value is null
        $sop->Document_Category = $request->input('Document_Category', null); // Default value is null
        $sop->Reviewed_Year = $request->input('Reviewed_Year', null); // Default value is null
        // Handle the sop_file as a string (single file)
        if ($request->has('sop_file')) {
            $sop->sop_file = $request->input('sop_file');
        }

        // Save the data to the database
        $sop->save();

        return response()->json(['message' => 'SOP uploaded successfully', 'sop' => $sop], 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve and return the specific SOP record based on the given ID
        $sop = Sop::find($id);
        if ($sop) {
            return response()->json(['sop' => $sop], 200);
        } else {
            return response()->json(['error' => 'SOP not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'uploaded_by' => 'required|string',
            'date' => 'date',
            'sop_title' => 'required|string',
            'business_unit' => 'required|string',
            'Division' =>'string',
            'Document_Category' => 'string',
            'Reviewed_Year' => ''
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $sop = Sop::find($id);
        if ($sop) {
            // Update the SOP record with the new values
            $sop->update($request->all());

            return response()->json(['message' => 'SOP updated successfully', 'sop' => $sop], 200);
        } else {
            return response()->json(['error' => 'SOP not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sop = Sop::find($id);
        if ($sop) {
            // Delete the SOP record from the database
            $sop->delete();

            return response()->json(['message' => 'SOP deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'SOP not found'], 404);
        }
    }
}
