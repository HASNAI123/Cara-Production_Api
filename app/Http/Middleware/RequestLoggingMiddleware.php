<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RequestLoggingMiddleware
{
    public function handle($request, Closure $next)
    {
        // Log the request details
        $requestData = [
            'method' => $request->method(),
            'url' => $request->url(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'parameters' => $request->all(),
        ];

        Log::info('API Request', $requestData);

        return $next($request);
    }
}
