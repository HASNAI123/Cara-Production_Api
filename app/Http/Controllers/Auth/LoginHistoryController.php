<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function index()
    {
        // Get all login histories
        $loginHistories = LoginHistory::all();
        return response()->json($loginHistories);
    }

    public function show($id)
    {
        // Get a single login history record by id
        $loginHistory = LoginHistory::findOrFail($id);
        return response()->json($loginHistory);
    }
}
