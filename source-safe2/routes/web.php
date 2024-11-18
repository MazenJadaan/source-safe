<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class,'loginPage']);

Route::view('Home', 'main.layout');
