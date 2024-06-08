<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Generatesop;

class HomeController extends Controller
{
    public function total_users()
    {
    	$total_users = User::all()->count();

    	return response()->json([
            'Total_users' => $total_users,
        ], 201);
    }


     public function total_generatesops()
    {
    	$inprogress_sop = Generatesop::where('status','In-Progress')->count();
        $reviewed_sop = Generatesop::where('status','Reviewed')->count();
        $approved_sop = Generatesop::where('status','Approved')->count();
    	
    	return response()->json([
            'In-Progress' => $inprogress_sop,
            'Reviewed' => $reviewed_sop,
            'Approved' => $approved_sop
        ], 201);
    }
}
