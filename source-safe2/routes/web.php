<?php

use App\Http\Controllers\Auth\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::view('Home', 'main.layout');
Route::get('/login', [AdminController::class, 'loginPage'])->name('loginPage');
