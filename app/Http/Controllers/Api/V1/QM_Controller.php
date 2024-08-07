<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QM_HACCP;
use App\Models\QM_WHACCP;
use App\Models\QM_QAA_Aeon;
use App\Models\QM_QAA_Aeon_big;
use App\Models\QM_QAA_Maxvalue;


class QM_Controller extends Controller
{
//QUALITY MANAGEMENT
    // HACCP
    public function HACCP(Request $request)
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
        $remark = new QM_HACCP([
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

    public function getHACCPById($id)
    {
        // Find the RemarkSA model by ID
        $remark = QM_HACCP::find($id);

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

    public function updateHACCPAById(Request $request, $id)
{

    $remark = QM_HACCP::find($id);

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

public function HACCPAll()
{
    // Retrieve all remarks from the database
    $remarks = QM_HACCP::all();

    return response()->json([
        'data' => $remarks,
    ]);
}

public function deleteBeautyById($id)
{
    // Find the RemarkSA model by ID
    $remark = QM_HACCP::find($id);

    // Check if the remark exists
    if (!$remark) {
        return response()->json(['message' => 'Remark not found'], 404);
    }

    // Delete the remark
    $remark->delete();

    return response()->json(['message' => 'Remark deleted successfully'], 200);
}


// Without HACCP

public function WHACCP(Request $request)
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
    $remark = new QM_WHACCP([
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

public function getWHACCPById($id)
{
    // Find the RemarkSA model by ID
    $remark = QM_WHACCP::find($id);

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

public function updateWHACCPAById(Request $request, $id)
{

$remark = QM_WHACCP::find($id);

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

public function WHACCPAll()
{
// Retrieve all remarks from the database
$remarks = QM_WHACCP::all();

return response()->json([
    'data' => $remarks,
]);
}

public function deleteWHACCPById($id)
{
// Find the RemarkSA model by ID
$remark = QM_WHACCP::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}









 // QM_QAA_AEON
 public function QM_QAA_AEON_store(Request $request)
{
    // Increase the maximum execution time to 300 seconds
    set_time_limit(300);

    try {
        // Validate the request data
        $validatedData = $request->validate([
            'PreparorID' => 'nullable|string',
            'StoreCode' => 'required|string',
            'RemarksData' => 'required|array', // Ensure RemarksData is an array
            'RemarksData.*.departmentscores' => 'nullable|array', // Allow departmentscores to be an array
            'CreatorID' => 'nullable|string',
            'CreatorName' => 'nullable|string',
            'PreparorName' => 'nullable|string',
            'Condition' => 'nullable|string',
            'Expiry_content' => 'nullable|string', // Validate as string initially
        ]);

        // Retrieve and decode the array of JSON objects from the request
        $dataArray = $request->input('RemarksData');

        // Additional parameters from the request body
        $creatorId = $request->input('CreatorID');
        $creatorName = $request->input('CreatorName');
        $preparorId = $request->input('PreparorID');
        $preparorName = $request->input('PreparorName');
        $storeCode = $request->input('StoreCode');
        $condition = $request->input('Condition');

        // Decode Expiry_content if it's not null
        $expiryContent = $request->input('Expiry_content') ? json_decode($request->input('Expiry_content'), true) : null;

        // Check if Expiry_content is a valid array after decoding
        if ($expiryContent !== null && !is_array($expiryContent)) {
            throw new \Exception('Expiry content must be a valid JSON array.');
        }

        // Create a new Remark model instance with the additional parameters
        $remark = new QM_QAA_Aeon([
            'CreatorID' => $creatorId,
            'CreatorName' => $creatorName,
            'PreparorID' => $preparorId,
            'PreparorName' => $preparorName,
            'StoreCode' => $storeCode,
            'Condition' => $condition,
            'remark_data' => json_encode($dataArray), // Store RemarksData separately
            'Expiry_content' => json_encode($expiryContent) // Encode back to JSON for storage if necessary
        ]);

        // Save the data to the database
        $remark->save();

        return response()->json([
            'message' => 'Remarks stored successfully',
            'data' => $remark,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while storing the remarks',
            'message' => $e->getMessage(),
        ], 500);
    }
}





 public function getQM_QAA_AEON_ById($id)
 {
     // Find the RemarkSA model by ID
     $remark = QM_QAA_Aeon::find($id);

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

 public function updateQM_QAA_AEONById(Request $request, $id)
 {
     try {
         // Find the remark by ID
         $remark = QM_QAA_Aeon::find($id);

         // Check if the remark exists
         if (!$remark) {
             return response()->json(['message' => 'Remark not found'], 404);
         }

         // Validate the request data
         $validatedData = $request->validate([
             'RemarksData' => 'required|array', // Ensure RemarksData is an array
             'RemarksData.*.departmentscores' => 'nullable|array', // Allow departmentscores to be an array
             'Expiry_content' => 'nullable|string', // Validate Expiry_content as a string
         ]);

         // Retrieve the array of JSON objects from the request
         $dataArray = $request->input('RemarksData');

         // Decode Expiry_content if it's not null
         $expiryContent = $request->input('Expiry_content') ? json_decode($request->input('Expiry_content'), true) : null;

         // Check if Expiry_content is a valid array after decoding
         if ($expiryContent !== null && !is_array($expiryContent)) {
             throw new \Exception('Expiry content must be a valid JSON array.');
         }

         // Update the 'remark_data' and 'expiry_content' fields with the new data
         $remark->remark_data = json_encode($dataArray);
         $remark->expiry_content = json_encode($expiryContent); // Encode back to JSON for storage if necessary

         // Save the updated data to the database
         $remark->save();

         return response()->json([
             'message' => 'Remarks updated successfully',
         ], 200);
     } catch (\Exception $e) {
         return response()->json([
             'error' => 'An error occurred while updating the remarks',
             'message' => $e->getMessage(),
         ], 500);
     }
 }




public function QM_QAA_AEON_All()
{
 // Retrieve all remarks from the database
 $remarks = QM_QAA_Aeon::all();

 return response()->json([
     'data' => $remarks,
 ]);
}

public function delete_QM_QAA_AEONById($id)
{
 // Find the RemarkSA model by ID
 $remark = QM_QAA_Aeon::find($id);

 // Check if the remark exists
 if (!$remark) {
     return response()->json(['message' => 'Remark not found'], 404);
 }

 // Delete the remark
 $remark->delete();

 return response()->json(['message' => 'Remark deleted successfully'], 200);
}











// QM_QAA_AEON_Big
public function QM_QAA_Aeon_big_store(Request $request)
{
    set_time_limit(300);

    try {
        // Validate the request data
        $validatedData = $request->validate([
            'PreparorID' => 'nullable|string',
            'StoreCode' => 'required|string',
            'RemarksData' => 'required|array', // Ensure RemarksData is an array
            'RemarksData.*.departmentscores' => 'nullable|array', // Allow departmentscores to be an array
            'CreatorID' => 'nullable|string',
            'CreatorName' => 'nullable|string',
            'PreparorName' => 'nullable|string',
            'Condition' => 'nullable|string',
            'Expiry_content' => 'nullable|string', // Validate as string initially
        ]);

        // Retrieve and decode the array of JSON objects from the request
        $dataArray = $request->input('RemarksData');

        // Additional parameters from the request body
        $creatorId = $request->input('CreatorID');
        $creatorName = $request->input('CreatorName');
        $preparorId = $request->input('PreparorID');
        $preparorName = $request->input('PreparorName');
        $storeCode = $request->input('StoreCode');
        $condition = $request->input('Condition');

        // Decode Expiry_content if it's not null
        $expiryContent = $request->input('Expiry_content') ? json_decode($request->input('Expiry_content'), true) : null;

        // Check if Expiry_content is a valid array after decoding
        if ($expiryContent !== null && !is_array($expiryContent)) {
            throw new \Exception('Expiry content must be a valid JSON array.');
        }

        // Create a new Remark model instance with the additional parameters
        $remark = new QM_QAA_Aeon_big([
            'CreatorID' => $creatorId,
            'CreatorName' => $creatorName,
            'PreparorID' => $preparorId,
            'PreparorName' => $preparorName,
            'StoreCode' => $storeCode,
            'Condition' => $condition,
            'remark_data' => json_encode($dataArray), // Store RemarksData separately
            'Expiry_content' => json_encode($expiryContent) // Encode back to JSON for storage if necessary
        ]);

        // Save the data to the database
        $remark->save();

        return response()->json([
            'message' => 'Remarks stored successfully',
            'data' => $remark,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while storing the remarks',
            'message' => $e->getMessage(),
        ], 500);
    }
}

public function getQM_QAA_Aeon_big_ById($id)
{
    // Find the RemarkSA model by ID
    $remark = QM_QAA_Aeon_big::find($id);

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

public function updateQM_QAA_Aeon_bigById(Request $request, $id)
{

    try {
        // Find the remark by ID
        $remark = QM_QAA_Aeon_big::find($id);

        // Check if the remark exists
        if (!$remark) {
            return response()->json(['message' => 'Remark not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'RemarksData' => 'required|array', // Ensure RemarksData is an array
            'RemarksData.*.departmentscores' => 'nullable|array', // Allow departmentscores to be an array
            'Expiry_content' => 'nullable|string', // Validate Expiry_content as a string
        ]);

        // Retrieve the array of JSON objects from the request
        $dataArray = $request->input('RemarksData');

        // Decode Expiry_content if it's not null
        $expiryContent = $request->input('Expiry_content') ? json_decode($request->input('Expiry_content'), true) : null;

        // Check if Expiry_content is a valid array after decoding
        if ($expiryContent !== null && !is_array($expiryContent)) {
            throw new \Exception('Expiry content must be a valid JSON array.');
        }

        // Update the 'remark_data' and 'expiry_content' fields with the new data
        $remark->remark_data = json_encode($dataArray);
        $remark->expiry_content = json_encode($expiryContent); // Encode back to JSON for storage if necessary

        // Save the updated data to the database
        $remark->save();

        return response()->json([
            'message' => 'Remarks updated successfully',
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while updating the remarks',
            'message' => $e->getMessage(),
        ], 500);
    }

}

public function QM_QAA_Aeon_big_All()
{
// Retrieve all remarks from the database
$remarks = QM_QAA_Aeon_big::all();

return response()->json([
    'data' => $remarks,
]);
}

public function delete_QM_QAA_Aeon_bigById($id)
{
// Find the RemarkSA model by ID
$remark = QM_QAA_Aeon_big::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}








// QM_QAA_AEON_Maxvalue
public function QM_QAA_Maxvalue_store(Request $request)
{
    set_time_limit(300);

    try {
        // Validate the request data
        $validatedData = $request->validate([
            'PreparorID' => 'nullable|string',
            'StoreCode' => 'required|string',
            'RemarksData' => 'required|array', // Ensure RemarksData is an array
            'RemarksData.*.departmentscores' => 'nullable|array', // Allow departmentscores to be an array
            'CreatorID' => 'nullable|string',
            'CreatorName' => 'nullable|string',
            'PreparorName' => 'nullable|string',
            'Condition' => 'nullable|string',
            'Expiry_content' => 'nullable|string', // Validate as string initially
        ]);

        // Retrieve and decode the array of JSON objects from the request
        $dataArray = $request->input('RemarksData');

        // Additional parameters from the request body
        $creatorId = $request->input('CreatorID');
        $creatorName = $request->input('CreatorName');
        $preparorId = $request->input('PreparorID');
        $preparorName = $request->input('PreparorName');
        $storeCode = $request->input('StoreCode');
        $condition = $request->input('Condition');

        // Decode Expiry_content if it's not null
        $expiryContent = $request->input('Expiry_content') ? json_decode($request->input('Expiry_content'), true) : null;

        // Check if Expiry_content is a valid array after decoding
        if ($expiryContent !== null && !is_array($expiryContent)) {
            throw new \Exception('Expiry content must be a valid JSON array.');
        }

        // Create a new Remark model instance with the additional parameters
        $remark = new QM_QAA_Maxvalue([
            'CreatorID' => $creatorId,
            'CreatorName' => $creatorName,
            'PreparorID' => $preparorId,
            'PreparorName' => $preparorName,
            'StoreCode' => $storeCode,
            'Condition' => $condition,
            'remark_data' => json_encode($dataArray), // Store RemarksData separately
            'Expiry_content' => json_encode($expiryContent) // Encode back to JSON for storage if necessary
        ]);

        // Save the data to the database
        $remark->save();

        return response()->json([
            'message' => 'Remarks stored successfully',
            'data' => $remark,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while storing the remarks',
            'message' => $e->getMessage(),
        ], 500);
    }
}

public function getQM_QAA_Maxvalue_ById($id)
{
    // Find the RemarkSA model by ID
    $remark = QM_QAA_Maxvalue::find($id);

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

public function updateQM_QAA_MaxvalueById(Request $request, $id)
{

    try {
        // Find the remark by ID
        $remark = QM_QAA_Maxvalue::find($id);

        // Check if the remark exists
        if (!$remark) {
            return response()->json(['message' => 'Remark not found'], 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'RemarksData' => 'required|array', // Ensure RemarksData is an array
            'RemarksData.*.departmentscores' => 'nullable|array', // Allow departmentscores to be an array
            'Expiry_content' => 'nullable|string', // Validate Expiry_content as a string
        ]);

        // Retrieve the array of JSON objects from the request
        $dataArray = $request->input('RemarksData');

        // Decode Expiry_content if it's not null
        $expiryContent = $request->input('Expiry_content') ? json_decode($request->input('Expiry_content'), true) : null;

        // Check if Expiry_content is a valid array after decoding
        if ($expiryContent !== null && !is_array($expiryContent)) {
            throw new \Exception('Expiry content must be a valid JSON array.');
        }

        // Update the 'remark_data' and 'expiry_content' fields with the new data
        $remark->remark_data = json_encode($dataArray);
        $remark->expiry_content = json_encode($expiryContent); // Encode back to JSON for storage if necessary

        // Save the updated data to the database
        $remark->save();

        return response()->json([
            'message' => 'Remarks updated successfully',
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred while updating the remarks',
            'message' => $e->getMessage(),
        ], 500);
    }

}

public function QM_QAA_Maxvalue_All()
{
// Retrieve all remarks from the database
$remarks = QM_QAA_Maxvalue::all();

return response()->json([
    'data' => $remarks,
]);
}

public function delete_QM_QAA_MaxvalueById($id)
{
// Find the RemarkSA model by ID
$remark = QM_QAA_Maxvalue::find($id);

// Check if the remark exists
if (!$remark) {
    return response()->json(['message' => 'Remark not found'], 404);
}

// Delete the remark
$remark->delete();

return response()->json(['message' => 'Remark deleted successfully'], 200);
}

}


