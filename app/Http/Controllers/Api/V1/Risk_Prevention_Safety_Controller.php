<?php
namespace App\Http\Controllers\Api\v1;

use App\Models\Risk_Prevention_Safety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Risk_Prevention_Safety_Controller extends Controller
{
    public function index()
    {
        return Risk_Prevention_Safety::all();
    }

    public function store(Request $request)
    {
        return Risk_Prevention_Safety::create($request->all());
    }

    public function show(Risk_Prevention_Safety $risk_Prevention_Safety)
    {
        return $risk_Prevention_Safety;
    }

    public function update(Request $request, Risk_Prevention_Safety $risk_Prevention_Safety)
    {
        $risk_Prevention_Safety->update($request->all());
        return $risk_Prevention_Safety;
    }

    public function destroy(Risk_Prevention_Safety $risk_Prevention_Safety)
    {
        $risk_Prevention_Safety->delete();
        return response()->json(null, 204);
    }
}
