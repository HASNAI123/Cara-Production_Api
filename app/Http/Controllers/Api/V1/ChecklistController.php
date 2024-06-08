<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Securitymaxvalue;
use App\Models\RemarkSAB;
use App\Models\RemarkSA;
use App\Models\Aeon_Security_Store;

class ChecklistController extends Controller
{
    public function SAstore(Request $request)
{
    // Validate the request data if needed
    $validatedData = $request->validate([
        // Define validation rules here
    ]);

    // Retrieve the array of JSON objects from the request
    $dataArray = $request->json()->get('RemarksData');

    // Check if the JSON data is valid
    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json([
            'message' => 'Invalid JSON data provided',
        ], 400);
    }

    // Additional parameters from the request body
    $creatorId = $request->input('CreatorID');
    $creatorName = $request->input('CreatorName');
    $preparorId = $request->input('PreparorID');
    $preparorName = $request->input('PreparorName');
    $storeCode = $request->input('StoreCode');

    // Create a new Remark model instance with the additional parameters
    $remark = new RemarkSA([
        'CreatorID' => $creatorId,
        'CreatorName' => $creatorName,
        'PreparorID' => $preparorId,
        'PreparorName' => $preparorName,
        'StoreCode' => $storeCode,
        'remark_data' => json_encode($dataArray), // Store RemarksData separately
    ]);

    // Save the data to the database
    try {
        // Save the data to the database
        $remark->save();

        return response()->json([
            'message' => 'Remarks stored successfully',
            'data' => $remark,
        ], 201);
    } catch (\Exception $e) {
        // Return a response with a 500 status code and an error message
        return response()->json([
            'message' => 'Failed to store remarks: ' . $e->getMessage(),
        ], 500);
    }
}

    public function getRemarkSAById($id)
{
    // Find the RemarkSA model by ID
    $remark = RemarkSA::find($id);

    // Check if the remark exists
    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Decode the JSON data to an array
    $dataArray = json_decode($remark->remark_data, true);

    return response()->json([
        'message' => 'Remark found',
        'data' => [
            'remark' => $remark,
            'dataArray' => $dataArray,
        ],
    ], 200);
}

public function updateRemarkSAById(Request $request, $id)
{

    $remark = RemarkSA::find($id);

    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Retrieve the array of JSON objects from the request
    $dataArray = $request->json()->get('RemarksData');

    // Update the 'remark_data' field with the new data
    $remark->remark_data = json_encode($dataArray);

    // Save the updated data to the database
    $remark->save();

    return response()->json([
        'message' => 'Remarks updated successfully',
    ], 200);
}


public function deleteRemarkSAById($id)
{
    // Find the RemarkSA model by ID
    $remark = RemarkSA::find($id);

    // Check if the remark exists
    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Delete the remark
    $remark->delete();

    return response()->json(['message' => 'Remark deleted successfully'], 200);
}











    public function SABstore(Request $request)
    {
        // Validate the request data if needed
        $validatedData = $request->validate([
            // Define validation rules here
        ]);

        // Retrieve the array of JSON objects from the request
        $dataArray = $request->json()->get('RemarksData');

        // Additional parameters from the request body
        $creatorId = $request->input('CreatorID');
        $creatorName = $request->input('CreatorName');
        $preparorId = $request->input('PreparorID');
        $preparorName = $request->input('PreparorName');
        $storeCode = $request->input('StoreCode');

        // Create a new Remark model instance with the additional parameters
        $remark = new RemarkSAB([
            'CreatorID' => $creatorId,
            'CreatorName' => $creatorName,
            'PreparorID' => $preparorId,
            'PreparorName' => $preparorName,
            'StoreCode' => $storeCode,
            'remark_data' => json_encode($dataArray), // Store RemarksData separately
        ]);

        // Save the data to the database
        $remark->save();

        return response()->json([
            'message' => 'Remarks stored successfully',
            'data' => $remark,
        ], 201);
    }



public function index()
{
    // Retrieve all remarks from the database
    $remarks = RemarkSA::all();

    return response()->json([
        'data' => $remarks,
    ]);
}

public function GETSAB()
{
    // Retrieve all remarks from the database
    $remarks = RemarkSAB::all();

    return response()->json([
        'data' => $remarks,
    ]);
}

public function getRemarkSABById($id)
{
    // Find the RemarkSA model by ID
    $remark = RemarkSAB::find($id);

    // Check if the remark exists
    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Decode the JSON data to an array
    $dataArray = json_decode($remark->remark_data, true);

    return response()->json([
        'message' => 'Remark found',
        'data' => [
            'remark' => $remark,
            'dataArray' => $dataArray,
        ],
    ], 200);
}

public function updateRemarkSABById(Request $request, $id)
{
    // Find the RemarkSA model by ID
    $remark = RemarkSAB::find($id);

    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Retrieve the array of JSON objects from the request
    $dataArray = $request->json()->get('RemarksData');

    // Update the 'remark_data' field with the new data
    $remark->remark_data = json_encode($dataArray);

    // Save the updated data to the database
    $remark->save();

    return response()->json([
        'message' => 'Remarks updated successfully',
    ], 200);
}

public function deleteRemarkSABById($id)
{
    // Find the RemarkSA model by ID
    $remark = RemarkSAB::find($id);

    // Check if the remark exists
    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Delete the remark
    $remark->delete();

    return response()->json(['message' => 'Remark deleted successfully'], 200);
}

// Secuirty Aeon Store
public function Aeon_Secuirty_store_store(Request $request)
{
    // Validate the request data if needed
    $validatedData = $request->validate([
        // Define validation rules here
    ]);

    // Retrieve the array of JSON objects from the request
    $dataArray = $request->json()->get('RemarksData');

    // Additional parameters from the request body
    $creatorId = $request->input('CreatorID');
    $creatorName = $request->input('CreatorName');
    $preparorId = $request->input('PreparorID');
    $preparorName = $request->input('PreparorName');
    $storeCode = $request->input('StoreCode');

    // Create a new Remark model instance with the additional parameters
    $remark = new Aeon_Security_Store([
        'CreatorID' => $creatorId,
        'CreatorName' => $creatorName,
        'PreparorID' => $preparorId,
        'PreparorName' => $preparorName,
        'StoreCode' => $storeCode,
        'remark_data' => json_encode($dataArray), // Store RemarksData separately
    ]);

    // Save the data to the database
    $remark->save();

    return response()->json([
        'message' => 'Remarks stored successfully',
        'data' => $remark,
    ], 201);
}



public function Aeon_Secuirty_store_all()
{
// Retrieve all remarks from the database
$remarks = Aeon_Security_Store::all();

return response()->json([
    'data' => $remarks,
]);
}

public function getRemarkAeon_Secuirty_storeById($id)
{
// Find the RemarkSA model by ID
$remark = Aeon_Security_Store::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Decode the JSON data to an array
$dataArray = json_decode($remark->remark_data, true);

return response()->json([
    'message' => 'Remark found',
    'data' => [
        'remark' => $remark,
        'dataArray' => $dataArray,
    ],
], 200);
}

public function updateRemarkAeon_Secuirty_storeById(Request $request, $id)
{
// Find the RemarkSA model by ID
$remark = Aeon_Security_Store::find($id);

if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Retrieve the array of JSON objects from the request
$dataArray = $request->json()->get('RemarksData');

// Update the 'remark_data' field with the new data
$remark->remark_data = json_encode($dataArray);

// Save the updated data to the database
$remark->save();

return response()->json([
    'message' => 'Remarks updated successfully',
], 200);
}

public function deleteRemarkAeon_Secuirty_storeById($id)
{
// Find the RemarkSA model by ID
$remark = Aeon_Security_Store::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}
}
