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
    Route::get('group/details/{id}',[GroupController::class,'details'])->name('group.details');

    Route::get('/group/members', [GroupController::class, 'members'])->name('group.members');
    Route::get('/group/files', [GroupController::class, 'files'])->name('group.files');
    Route::get('/group/file-reports', [GroupController::class, 'fileReports'])->name('group.file-reports');
    Route::get('/group/member-reports', [GroupController::class, 'memberReports'])->name('group.member-reports');
    Route::get('/group/add-file-order', [GroupController::class, 'addFileOrder'])->name('group.add-file-order');





    ///////////// files //////////////
//    Route::get('files/create',[FilesController::class,'create'])->name('file.create');
    Route::post('files/store',[FilesController::class,'store'])->name('file.store');

    Route::get('files', [FilesController::class, 'getFilesUser'])->name('user.files');
    Route::get('my-files', [FilesController::class, 'getMyFiles'])->name('my.reservation.files');


    Route::post('/files/{file}/check-out', [FilesController::class, 'checkOut'])->name('files.check_out');
    Route::post('/files/{file}/check-in', [FilesController::class, 'checkIn'])->name('files.check_in');
    Route::get('/files/{file}/backups', [FilesController::class, 'viewBackups'])->name('files.backups');





    Route::get('/test',function (){
        return view('files.create');
    })->name('test');



});

Route::view("Files/All Files","files.allFiles");
