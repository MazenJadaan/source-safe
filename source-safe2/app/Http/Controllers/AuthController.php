<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }
    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Generate Refresh Token
            $refreshToken = Str::random(64);
            $expiresAt = now()->addDays(30); // Ensure '30' is an integer

            // Store the Refresh Token in the Database
            DB::table('refresh_tokens')->insert([
                'user_id' => Auth::id(),
                'refresh_token' => $refreshToken,
                'expires_at' => $expiresAt,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Store the Refresh Token in a Secure HTTP-Only Cookie
            cookie()->queue('refresh_token', $refreshToken, 60 * 24 * 30, '/', null, true, true);

            // Set Session Expiry based on 'session.lifetime' setting
            session()->put('expires_at', now()->addMinutes((int) config('session.lifetime')));

            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->with(['error' => 'Password is incorrect.']);
    }


    public function logout(Request $request)
    {
        DB::table('refresh_tokens')->where('user_id', Auth::id())->delete();


        Auth::logout();
        session()->flush();
        cookie()->queue(cookie()->forget('refresh_token'));

        return redirect('/login');
    }
    public function refreshToken(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');

        // Validate Refresh Token
        $tokenData = DB::table('refresh_tokens')
            ->where('refresh_token', $refreshToken)
            ->where('expires_at', '>', now())
            ->first();

        if (!$tokenData) {
            return response()->json(['message' => 'Invalid or expired refresh token'], 401);
        }

        // Renew Session and Refresh Token
        Auth::loginUsingId($tokenData->user_id);

        $newRefreshToken = Str::random(64);
        DB::table('refresh_tokens')
            ->where('refresh_token', $refreshToken)
            ->update(['refresh_token' => $newRefreshToken, 'expires_at' => now()->addDays(30)]);

        // Update HTTP-Only Cookie
        cookie()->queue('refresh_token', $newRefreshToken, 60 * 24 * 30, '/', null, true, true);

        // Extend Session Lifetime
        session()->put('expires_at', now()->addMinutes(config('session.lifetime')));

        return response()->json(['message' => 'Session refreshed successfully']);
    }
}
