<?php

namespace App\Http\Controllers\Api\v1;
use Illuminate\Support\Facades\DB;
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
    public function getTotalGeneratedSops()
{
    $count = Generatesop::count();
    return response()->json(['total' => $count]);
}
public function getTotalArchivedSops()
{
    $result = DB::select("SELECT COUNT(*) as count FROM sop WHERE deleted_at IS NULL OR deleted_at = ''");
    $count = $result[0]->count;
    return response()->json(['total' => $count]);
}

public function getAllGeneratedSops()
{
    $result = DB::select("SELECT COUNT(*) as count FROM generatesop WHERE deleted_at IS NULL OR deleted_at = ''");
    $count = $result[0]->count;
    return response()->json(['total' => $count]);
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

public function getDeleted()
{
    $deletedsops = Sop::onlyTrashed()
        ->whereNotNull('deleted_at')
        ->where('deleted_at', '!=', '')
        ->get();
    return response()->json(['data' => $deletedsops]);
}

public function recoverSop($id)
{
    $sop = Sop::withTrashed()->find($id);

    if (!$sop) {
        return response()->json(['error' => 'Sop not found.'], 404);
    }

    $sop->restore();

    return response()->json(['message' => 'Sop restored.']);
}
}
