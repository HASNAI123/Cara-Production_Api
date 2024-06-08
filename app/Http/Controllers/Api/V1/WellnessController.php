<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WellnessBeauty;
use App\Models\WellnessNutritionist;
use App\Models\WellnessOperations;
use App\Models\WellnessPharmacist;
use App\Models\WellnessLossPrevention;

class WellnessController extends Controller
{

    // WELLNESS BEAUTY
    public function beautystore(Request $request)
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
        $remark = new WellnessBeauty([
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

    public function getBeautyById($id)
    {
        // Find the RemarkSA model by ID
        $remark = WellnessBeauty::find($id);

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

    public function updateBeautyAById(Request $request, $id)
{

    $remark = WellnessBeauty::find($id);

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

public function BeautyAll()
{
    // Retrieve all remarks from the database
    $remarks = WellnessBeauty::all();

    return response()->json([
        'data' => $remarks,
    ]);
}

public function deleteBeautyById($id)
{
    // Find the RemarkSA model by ID
    $remark = WellnessBeauty::find($id);

    // Check if the remark exists
    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Delete the remark
    $remark->delete();

    return response()->json(['message' => 'Remark deleted successfully'], 200);
}



 // WELLNESS NUTRITIONIST


 public function NUTRITIONISTstore(Request $request)
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
     $remark = new WellnessNutritionist([
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

 public function getNUTRITIONISTById($id)
 {
     // Find the RemarkSA model by ID
     $remark = WellnessNutritionist::find($id);

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

 public function updateNUTRITIONISTyId(Request $request, $id)
{

 $remark = WellnessNutritionist::find($id);

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

public function NUTRITIONISTAll()
{
 // Retrieve all remarks from the database
 $remarks = WellnessNutritionist::all();

 return response()->json([
     'data' => $remarks,
 ]);
}

public function deleteNUTRITIONISTById($id)
{
 // Find the RemarkSA model by ID
 $remark = WellnessNutritionist::find($id);

 // Check if the remark exists
 if (!$remark) {
     return response()->json(['message' => 'Remark not found'], 404);
 }

 // Delete the remark
 $remark->delete();

 return response()->json(['message' => 'Remark deleted successfully'], 200);
}


// WELLNESS Operations


public function Operationsstore(Request $request)
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
    $remark = new WellnessOperations([
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

public function getOperationsById($id)
{
    // Find the RemarkSA model by ID
    $remark = WellnessOperations::find($id);

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

public function updateOperationsbyId(Request $request, $id)
{

$remark = WellnessOperations::find($id);

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

public function OperationsAll()
{
// Retrieve all remarks from the database
$remarks = WellnessOperations::all();

return response()->json([
    'data' => $remarks,
]);
}

public function deleteOperationsById($id)
{
// Find the RemarkSA model by ID
$remark = WellnessOperations::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}




// WELLNESS Pharmacist


public function Pharmaciststore(Request $request)
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
    $remark = new WellnessPharmacist([
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

public function getPharmacistById($id)
{
    // Find the RemarkSA model by ID
    $remark = WellnessPharmacist::find($id);

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

public function updatePharmacistbyId(Request $request, $id)
{

$remark = WellnessPharmacist::find($id);

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

public function PharmacistAll()
{
// Retrieve all remarks from the database
$remarks = WellnessPharmacist::all();

return response()->json([
    'data' => $remarks,
]);
}

public function deletePharmacistById($id)
{
// Find the RemarkSA model by ID
$remark = WellnessPharmacist::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}





// WELLNESS Loss Prevention


public function LossPreventionstore(Request $request)
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
    $remark = new WellnessLossPrevention([
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

public function getLossPreventionById($id)
{
    // Find the RemarkSA model by ID
    $remark = WellnessLossPrevention::find($id);

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

public function updateLossPreventionbyId(Request $request, $id)
{

$remark = WellnessLossPrevention::find($id);

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

public function LossPreventionAll()
{
// Retrieve all remarks from the database
$remarks = WellnessLossPrevention::all();

return response()->json([
    'data' => $remarks,
]);
}

public function deleteLossPreventionById($id)
{
// Find the RemarkSA model by ID
$remark = WellnessLossPrevention::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}



}
