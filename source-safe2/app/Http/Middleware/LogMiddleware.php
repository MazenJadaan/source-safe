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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $this->before($request);

            $response = $next($request);
            $this->onException($request,$response);
            $this->after($request, $response);

            return $response;
        } catch (\Exception $e) {
            return $this->onException($request, $e);
        }
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function before(Request $request)
    {
        Log::debug("Before handling request to " . $request->path());
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    protected function after(Request $request, Response $response)
    {
        Log::info("After handling request to " . $request->path() . " completed with status code " . $response->getStatusCode());
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function onException(Request $request, \Exception $exception): Response
    {
        Log::error("Exception occurred while handling request to " . $request->path() . ": " . $exception->getMessage());

        return response()->json([
            'error' => 'An unexpected error occurred.',
            'message' => $exception->getMessage(),
        ], 500);
    }
}