<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FilesRequestController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
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

    Route::get('/group/{id}/members', [GroupController::class, 'members'])->name('group.members');
    Route::get('/group/{id}/files', [GroupController::class, 'files'])->name('group.files');


    Route::get('/file/{id}/reports', [ReportsController::class, 'showFileReports'])->name('file.reports');
    Route::get('/member/{id}/reports', [ReportsController::class, 'showMemberReports'])->name('member.reports');


    Route::get('/group/{id}/files-orders', [GroupController::class, 'filesOrders'])->name('group.request.orders');
    Route::patch('/file/{id}/accept', [FilesRequestController::class, 'acceptFile'])->name('file.accept');
    Route::patch('/file/{id}/reject', [FilesRequestController::class, 'rejectFile'])->name('file.reject');
    Route::get('/file/{id}/download', [FilesRequestController::class, 'downloadFile'])->name('file.download');





    ///////////// files //////////////
//    Route::get('files/create',[FilesController::class,'create'])->name('file.create');
    Route::post('files/upload',[FilesRequestController::class,'upload'])->name('file.request.upload');


    Route::get('files', [FilesController::class, 'getFilesUser'])->name('user.files');
    Route::get('my-files', [FilesController::class, 'getMyFiles'])->name('my.reservation.files');

    Route::post('/files/{id}/check-in', [FilesController::class, 'checkIn'])->name('files.check-in');
    Route::post('/files/{id}/check-out', [FilesController::class, 'checkOut'])->name('files.checkOut');


    Route::get('/files/{file}/backups', [FilesController::class, 'viewBackups'])->name('files.backups');





    Route::get('/test',function (){
        return view('files.create');
    })->name('test');



});

Route::view("Files/All Files","files.allFiles");
/// notifications

Route::get('showNotifications', [UserController::class, 'showNotifications'])->name('showNotifications');
Route::post('markAllAsRead', [UserController::class, 'markAllAsRead'])->name('markAllAsRead');


// User::create([
//     'name' => 'moayad',
//     'email' => 'moayad@gmail.com',
//     'password' => bcrypt('12345678'),
//     'role_id' => 1,
// ]);
