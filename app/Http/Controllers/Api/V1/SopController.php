<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Sop;
use App\Models\Generatesop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SopController extends Controller
{
    public function getSop()
    {
        $sops = Sop::all();

        return response()->json($sops);
    }

    public function getAllGeneratedSops()
    {
        $sops = Generatesop::all();

        return response()->json($sops);
    }
    public function deleteSop($id)
    {
        $sop = Sop::find($id);

        if (!$sop) {
            return response()->json(['error' => 'SOP not found.'], 404);
        }

        $sop->delete();

        return response()->json(['message' => 'SOP deleted.']);
    }


    public function getRecentGeneratedSops()
{
    $recentSops = Generatesop::orderBy('created_at', 'desc')->take(5)->get();

    return response()->json($recentSops);
}


public function getRecentArchiveSops()
{
    $recentSops = Sop::orderBy('created_at', 'desc')->take(5)->get();

    return response()->json($recentSops);
}
}
