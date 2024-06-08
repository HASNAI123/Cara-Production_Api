<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function index()
    {
        // Get the log entries from the Laravel log file
        $logData = $this->parseLogFile(storage_path('logs/laravel.log'));

        dd($logData); // Add this line to inspect the data

        return response()->json($logData)->header('Cache-Control', 'no-cache');
    }


    private function parseLogFile($filePath)
    {
        // Read the log file and parse the log entries
        $logs = [];
        $fileContents = file_get_contents($filePath);

        // Debugging output to check if the file is being read
        dd($fileContents);

        preg_match_all('/\[([^\]]+)\]\s(\w+):\s(.+)/', $fileContents, $matches, PREG_SET_ORDER);

        // Debugging output to check if any matches are found
        dd($matches);

        // Rest of the code to process matches and return logs
        // ...
    }

}
