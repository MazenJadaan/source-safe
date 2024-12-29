<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\GroupController;
use App\Http\Middleware\RefreshSession;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('login/do',[AuthController::class,'doLogin'])->name('doLogin');

Route::view('Home', 'layouts.layouts');

Route::middleware(['auth',RefreshSession::class])->group(function () {
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/dashboard',function (){
        return view('dashboard');
    })->name('dashboard');

                       ///////////// groups //////////////
    Route::get('myGroups',[GroupController::class,'myGroups'])->name('userGroups');
    Route::get('group/create',[GroupController::class,'create'])->name('group.create');
    Route::post('group/store', [GroupController::class, 'store'])->name('group.store');
    Route::put('group/update/{group}', [GroupController::class, 'update'])->name('group.update');
    Route::delete('group/delete/{id}', [GroupController::class, 'delete'])->name('group.delete');




                      ///////////// files //////////////
    Route::get('files/create',[FilesController::class,'create'])->name('file.create');
    Route::post('files/store',[FilesController::class,'store'])->name('file.store');

    Route::get('/test',function (){
        return view('files.create');
    })->name('test');



});

Route::view("Files/All Files","files.allFiles");
