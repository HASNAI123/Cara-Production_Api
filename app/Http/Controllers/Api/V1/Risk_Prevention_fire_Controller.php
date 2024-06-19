<?php
namespace App\Http\Controllers\Api\v1;

use App\Models\Risk_Prevention_fire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Risk_Prevention_fire_Controller extends Controller
{
    public function index()
    {
        return Risk_Prevention_fire::all();
    }

    public function store(Request $request)
    {
        return Risk_Prevention_fire::create($request->all());
    }

    public function show(Risk_Prevention_fire $risk_Prevention_fire)
    {
        return $risk_Prevention_fire;
    }

    public function update(Request $request, Risk_Prevention_fire $risk_Prevention_fire)
    {
        $risk_Prevention_fire->update($request->all());
        return $risk_Prevention_fire;
    }

    public function destroy(Risk_Prevention_fire $risk_Prevention_fire)
    {
        $risk_Prevention_fire->delete();
        return response()->json(null, 204);
    }
}
