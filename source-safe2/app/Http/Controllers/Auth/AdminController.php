<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        // Initialization logic
    }

    public function loginPage()
    {
        return 'hi'; // Make sure the 'login' view exists in resources/views
    }

    public function login(Request $request)
    {
        return 'hi';
    }
}
