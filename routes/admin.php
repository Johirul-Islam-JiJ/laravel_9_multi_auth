<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => ['guest:admin'],'prefix'=>'admin','as'=>'admin.'],function(){
//    Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
//});

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/home', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin_profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/update/admin_profile/{id}', [\App\Http\Controllers\Admin\ProfileController::class, 'update_general'])->name('admin.update_general');
    Route::post('/admin_profile/password/{id}', [\App\Http\Controllers\Admin\ProfileController::class, 'update_password'])->name('admin.update.password');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

    //admin user module
    Route::get('/user/list',[AdminController::class,'allUser'])->name('admin.user');
    Route::get('/user/create',[AdminController::class,'userCreate'])->name('admin.user.create');
    Route::post('/user/store',[AdminController::class,'storeAdminUser'])->name('admin.user.store');
    Route::get('/user/edit/{id}', [AdminController::class,'editAdminUser'])->name('admin.user.edit');
    Route::post('/user/update/{id}', [AdminController::class, 'updateAdminUser'])->name('admin.user.update');
    Route::delete('/user/trash/{id}', [AdminController::class,  'trashAdminUser'])->name('admin.user.delete');
    Route::get('/user/deleted', [AdminController::class, 'adminUserDeleted'])->name('admin-user.deleted');
    Route::delete('/user/delete/{id}', [AdminController::class, 'adminUserDelete'])->name('admin-user.delete.forever');
    Route::put('/user/restore/{id}', [AdminController::class, 'adminUserRestore'])->name('admin-user.restore');


    //Roles module
    Route::resource('/roles', RoleController::class);
});
