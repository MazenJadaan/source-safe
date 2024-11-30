<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RefreshSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $sessionExpiresAt = session()->get('expires_at');

            if ($sessionExpiresAt && now()->greaterThanOrEqualTo($sessionExpiresAt)) {
                // Refresh session using the refresh token
                app('App\Http\Controllers\AuthController')->refreshToken($request);

                // Update session expiry
                session()->put('expires_at', now()->addMinutes(config('session.lifetime')));
            }
        }

        return $next($request);
    }
}
