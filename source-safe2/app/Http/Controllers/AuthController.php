<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }
    public function login(AuthRequest $authRequest){
        if (Auth::attempt(['email' => $authRequest->email, 'password' => $authRequest->password])) {
            $user = User::find(Auth::user()->id);

            $token=   $user_token['token'] = $user->createToken('appToken')->accessToken;
            return view('main.layout', ['token' => $token]); 

        }else
        return back()->withErrors([
            'email_or_username' => 'Invalid credentials'
        ])->withInput();
    }
    // public function store()
    // {
    //     if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
    //         // successfull authentication
    //         $user = User::find(Auth::user()->id);

    //         $user_token['token'] = $user->createToken('appToken')->accessToken;

    //         return response()->json([
    //             'success' => true,
    //             'token' => $user_token,
    //             'user' => $user,
    //         ], 200);
    //     } else {
    //         // failure to authenticate
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to authenticate.',
    //         ], 401);
    //     }
    // }
 
     public function logout()
     {
         Auth::logout();
         return redirect('/login');
     }
}
