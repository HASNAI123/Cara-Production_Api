<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function addPermissionsToRole(Request $request, $roleId)
    {
        // Get the permissions from the request
        $permissionNames = $request->input('permissions');

        // Find the role
        $role = Role::findOrFail($roleId);

        // Assign the permissions to the role
        $role->syncPermissions($permissionNames);

        // Return a success response
        return response()->json([
            'message' => 'Permissions added successfully'
        ], 200);
    }
}
