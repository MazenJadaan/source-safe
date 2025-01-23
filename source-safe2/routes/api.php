<?php

use App\Http\AdminController\AdminController;
use App\Http\Controllers\Auth\ManagerAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('login/do',[AuthController::class,'doLogin']);
Route::post('testlogin',[AuthController::class,'testlogin']);
Route::post('files/{id}/check-in', [FilesController::class, 'checkIn']);
