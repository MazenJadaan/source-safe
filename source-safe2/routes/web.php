<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Middleware\RefreshSession;
use Illuminate\Support\Facades\Route;


Route::get('/login',[AuthController::class,'login']);
Route::post('login/do',[AuthController::class,'doLogin'])->name('login');

Route::view('Home', 'layouts.layouts');

Route::middleware(['auth',RefreshSession::class])->group(function () {
    Route::get('/dashboard',function (){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/logout',[AuthController::class,'logout'])->name('logout');


    ///////////// groups ////////////////
Route::get('group/create',[GroupController::class,'create'])->name('group.create');
    Route::post('group/store', [GroupController::class, 'store'])->name('groups.store');


});
