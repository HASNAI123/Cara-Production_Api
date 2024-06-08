<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AeonMallAudit;
use App\Models\AeonStoreAudit;
use App\Models\AeonBigAudit;
use App\Models\AeonFPCAudit;


class SafetyController extends Controller
{

    //SAFET CHECKLIST 1
    // Aeon Mall Audit
    public function AeonMallAuditstore(Request $request)
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
        $remark = new AeonMallAudit([
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

    public function AeonMallAuditById($id)
    {
        // Find the RemarkSA model by ID
        $remark = AeonMallAudit::find($id);

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

    public function updateAeonMallAuditAById(Request $request, $id)
{

    $remark = AeonMallAudit::find($id);

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

public function AeonMallAuditAll()
{
    // Retrieve all remarks from the database
    $remarks = AeonMallAudit::all();

    return response()->json([
        'data' => $remarks,
    ]);
}

public function deleteAeonMallAuditById($id)
{
    // Find the RemarkSA model by ID
    $remark = AeonMallAudit::find($id);

    // Check if the remark exists
    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Delete the remark
    $remark->delete();

    return response()->json(['message' => 'Remark deleted successfully'], 200);
}


//SAFET CHECKLIST 2
// AEON STORE AUDIT


public function AeonStoreAuditstore(Request $request)
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
    $remark = new AeonStoreAudit([
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

public function AeonStoreAuditById($id)
{
    // Find the RemarkSA model by ID
    $remark = AeonStoreAudit::find($id);

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

public function updateAeonStoreAuditAById(Request $request, $id)
{

$remark = AeonStoreAudit::find($id);

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

public function AeonStoreAuditAll()
{
// Retrieve all remarks from the database
$remarks = AeonStoreAudit::all();

return response()->json([
    'data' => $remarks,
]);
}

public function deleteStoreMallAuditById($id)
{
// Find the RemarkSA model by ID
$remark = AeonStoreAudit::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}


//SAFET CHECKLIST 3
// AEON BIG AUDIT


public function AeonBigAuditstore(Request $request)
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
    $remark = new AeonBigAudit([
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

public function AeonBigAuditById($id)
{
    // Find the RemarkSA model by ID
    $remark = AeonBigAudit::find($id);

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

public function updateAeonBigAuditAById(Request $request, $id)
{

$remark = AeonBigAudit::find($id);

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

public function AeonBigAuditAll()
{
// Retrieve all remarks from the database
$remarks = AeonBigAudit::all();

return response()->json([
    'data' => $remarks,
]);
}

public function deleteBigMallAuditById($id)
{
// Find the RemarkSA model by ID
$remark = AeonBigAudit::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}



//SAFET CHECKLIST 4
// AEON FPC AUDIT


public function AeonFPCAuditstore(Request $request)
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
    $remark = new AeonFPCAudit([
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

public function AeonFPCAuditById($id)
{
    // Find the RemarkSA model by ID
    $remark = AeonFPCAudit::find($id);

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

public function updateAeonFPCAuditAById(Request $request, $id)
{

$remark = AeonFPCAudit::find($id);

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

public function AeonFPCAuditAll()
{
// Retrieve all remarks from the database
$remarks = AeonFPCAudit::all();

return response()->json([
    'data' => $remarks,
]);
}

public function deleteFPCMallAuditById($id)
{
// Find the RemarkSA model by ID
$remark = AeonFPCAudit::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}


}
