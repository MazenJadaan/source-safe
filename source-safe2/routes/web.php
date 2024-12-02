<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\RefreshSession;
use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    return view('dashboard');
})->name('dashboard');


Route::get('/login',[AuthController::class,'loginPage']);
Route::post('/login',[AuthController::class,'login'])->name('login');


Route::view('Home', 'layouts.layouts');

Route::middleware(['auth',RefreshSession::class])->group(function () {
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/dashboard',function (){
        return view('layouts.app');
    })->name('dashboard');
    
});