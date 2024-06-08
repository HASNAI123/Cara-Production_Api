<?php
namespace App\Http\Controllers\Api\v1;

use App\Models\Risk_Prevention_Security;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Risk_Prevention_Security_Controller extends Controller
{
    public function index()
    {
        return Risk_Prevention_Security::all();
    }

    public function store(Request $request)
    {
        return Risk_Prevention_Security::create($request->all());
    }

    public function show(Risk_Prevention_Security $risk_Prevention_Security)
    {
        return $risk_Prevention_Security;
    }

    public function update(Request $request, Risk_Prevention_Security $risk_Prevention_Security)
    {
        $risk_Prevention_Security->update($request->all());
        return $risk_Prevention_Security;
    }

    public function destroy(Risk_Prevention_Security $risk_Prevention_Security)
    {
        $risk_Prevention_Security->delete();
        return response()->json(null, 204);
    }
}
