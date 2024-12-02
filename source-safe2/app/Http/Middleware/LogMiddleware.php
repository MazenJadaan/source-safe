<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Log the request path before handling the request
        Log::debug("Handling request to " . $request->path());

        // Process the request and get the response
        $response = $next($request);

        // Log the response status code after handling the request
        Log::info("Request to " . $request->path() . " completed with status code " . $response->getStatusCode());

        return $response;
    }
}
