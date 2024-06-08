<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcknowledgmentArchive;
use App\Models\AcknowledgmentLibrary;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Archive_AcknowledgmentExport;
use App\Exports\Library_AcknowledgmentExport;

class AcknowlegdementController extends Controller
{
    public function archive_All_reports()
    {
        return  Excel::download(new Archive_AcknowledgmentExport, 'acknowledgments1.xlsx');
    }

    public function archive_store(Request $request)
    {
        $request->validate([
            'User_id' => 'required',
            'Sop_title' => 'required',
            'user_name' => 'required',
            'Terms_1' => 'required',
            'Terms_2' => 'nullable',
            'Date_Downloaded' => 'date',
            'Type' => 'nullable'
        ]);

        $acknowledgmentArchive = AcknowledgmentArchive::create([
            'User_id' => $request->input('User_id'),
            'user_name' => $request->input('user_name'),
            'Sop_title' => $request->input('Sop_title'),
            'Terms_1' => $request->input('Terms_1'),
            'Terms_2' => $request->input('Terms_2'),
            'Date_Downloaded' => $request->input('Date_Downloaded') ?? now(),
            'Type' => $request->input('Type')
        ]);

        return response()->json(['message' => 'Data saved successfully', 'data' => $acknowledgmentArchive], 201);

    }


    public function library_All_reports()
    {
        return Excel::download(new Library_AcknowledgmentExport, 'acknowledgments.xlsx');
    }

    public function library_store(Request $request)
    {
        $request->validate([
            'User_id' => 'required',
            'Sop_title' => 'required',
            'user_name' => 'required',
            'Terms_1' => 'required',
            'Terms_2' => 'nullable',
            'Date_Downloaded' => 'date',
            'Type' => 'nullable'
        ]);

        AcknowledgmentLibrary::create([
            'User_id' => $request->input('User_id'),
            'user_name' => $request->input('user_name'),
            'Sop_title' => $request->input('Sop_title'),
            'Terms_1' => $request->input('Terms_1'),
            'Terms_2' => $request->input('Terms_2'),
            'Date_Downloaded' => $request->input('Date_Downloaded') ?? now(),
            'Type' => $request->input('Type')
        ]);

        return response()->json(['message' => 'Data saved successfully'], 201);
    }




}
