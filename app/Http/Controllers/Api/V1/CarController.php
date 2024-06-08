<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Car;

class CarController extends Controller
{

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'NonConformity'  => 'nullable|string',
            'DetailsNonConformity' => 'nullable|string',
            'description3' => 'nullable|string',
            'description4' => 'nullable|string',
            'description5' => 'nullable|string',
            'description6' => 'nullable|string',
            'description7' => 'nullable|string',
            'description8' => 'nullable|string',
            'checklist_type' => 'required|string',
            'selected_radio' => 'nullable|string',
        ]);

        // Create a new checklist record
        $checklist = Car::create($validatedData);

        return response()->json(['message' => 'Car Form created successfully', 'data' => $checklist]);
    }

    public function getFormById($id)
    {
        try {
            // Retrieve the checklist by ID
            $checklist = Car::findOrFail($id);

            // Return the checklist as JSON response
            return response()->json([
                'success' => true,
                'data' => $checklist,
            ]);
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving checklist.',
            ], 500);
        }
    }
    public function getAllforms()
    {
        try {
            // Retrieve all checklists
            $checklists = Car::all();

            // Return the checklists as JSON response
            return response()->json([
                'success' => true,
                'data' => $checklists,
            ]);
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving checklists.',
            ], 500);
        }
    }


    public function updateForm($id, Request $request)
    {
        try {
            // Find the checklist by ID
            $checklist = Car::find($id);

            // Check if the checklist exists
            if (!$checklist) {
                return response()->json([
                    'success' => false,
                    'message' => 'Checklist not found.',
                ], 404);
            }

            // Update the checklist with the new data
            $checklist->update($request->all());

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Checklist updated successfully.',
                'data' => $checklist,
            ]);
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return response()->json([
                'success' => false,
                'message' => 'Error updating checklist.',
            ], 500);
        }
    }

    public function deleteform($id)
    {
        try {
            // Find the checklist by ID
            $checklist = Car::find($id);

            // Check if the checklist exists
            if (!$checklist) {
                return response()->json([
                    'success' => false,
                    'message' => 'Checklist not found.',
                ], 404);
            }

            // Delete the checklist
            $checklist->delete();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Checklist deleted successfully.',
            ]);
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return response()->json([
                'success' => false,
                'message' => 'Error deleting checklist.',
            ], 500);
        }
    }
}
