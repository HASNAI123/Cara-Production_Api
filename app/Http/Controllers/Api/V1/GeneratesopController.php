<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generatesop;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\AwsS3V3\PortableVisibilityConverter;




class GeneratesopController extends Controller
{
    public function index()
    {
        $generatesop = Generatesop::all();

        return response()->json($generatesop);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:500000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid file'], 400);
        }

        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('images', $image);
        $url = Storage::disk('s3')->url($path);

        return response()->json(['url' => $url], 200);
    }


    public function show($id)
    {
        $generatesop = Generatesop::find($id);

        if (!$generatesop) {
            return response()->json(['error' => 'Generatesop not found.'], 404);
        }

        return response()->json($generatesop);
    }

    public function store(Request $request)
    {
        $generatesop = new Generatesop($request->all());


        $generatesop->save();

        return response()->json($generatesop, 201);
    }

    public function update(Request $request, $id)
    {
        $generatesop = Generatesop::find($id);

        if (!$generatesop) {
            return response()->json(['error' => 'Generatesop not found.'], 404);
        }

        if ($request->has('action')) {
            $action = $request->input('action');
            $newAction = [
                'name' => $action['name'] ?? null,
                'time' => $action['time'] ?? null,
                'by' => $action['by'] ?? null,
                'id' => $action['id'] ?? null,
                'business_unit' => $action['business_unit'] ?? null,
            ];
            // Append the new action to the existing 'action' array
            $generatesop->action = array_merge($generatesop->action ?? [], [$newAction]);
        }

        // Remove 'action' from the request data
        $requestData = $request->except('action');

        $generatesop->fill($requestData);

        $generatesop->save();

        return response()->json($generatesop);
    }

    public function destroy($id)
    {
        $generatesop = Generatesop::find($id);

        if (!$generatesop) {
            return response()->json(['error' => 'Generatesop not found.'], 404);
        }

        $generatesop->delete();

        return response()->json(['message' => 'Generatesop deleted.']);
    }

    public function getDeleted()
    {
        $deletedGeneratesops = Generatesop::onlyTrashed()
            ->whereNotNull('deleted_at')
            ->where('deleted_at', '!=', '')
            ->get();
        return response()->json(['data' => $deletedGeneratesops]);
    }


public function restore($id)
{
    $generatesop = Generatesop::withTrashed()->find($id);

    if (!$generatesop) {
        return response()->json(['error' => 'Generatesop not found.'], 404);
    }

    $generatesop->restore();

    return response()->json(['message' => 'Generatesop restored.']);
}
}
