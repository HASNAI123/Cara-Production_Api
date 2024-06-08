<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChangeRequest;

class ChangeRequestController extends Controller
{
    public function saveFormData(Request $request)
    {
        $formData = $request->validate([
            'report_number' => 'nullable',
            'selected_budget' => 'nullable',
            'selected_com' => 'nullable',
            'selected_status' => 'nullable',
            'selected_approver' => 'nullable',
            'date1' => 'nullable|date',
            'requested_by_name' => 'nullable',
            'requested_by_staff_id' => 'nullable',
            'change_request_name' => 'nullable',
            'change_description' => 'nullable',
            'change_reason' => 'nullable',
            'impact_of_change_scope' => 'nullable',
            'impact_of_change_budget' => 'nullable',
            'impact_of_change_timeline' => 'nullable',
            'impact_of_change_resourcing' => 'nullable',
            'impact_of_change_communications' => 'nullable',
            'impact_of_change_other' => 'nullable',
            'proposed_action' => 'nullable',
        ]);

        // Save the form data to the 'change_requests' table using the ChangeRequest model
        ChangeRequest::create($formData);

        return response()->json(['message' => 'Form data saved successfully']);
    }

    public function getAllChangeRequests()
    {
        $changeRequests = ChangeRequest::all();

        return response()->json($changeRequests);
    }
}
