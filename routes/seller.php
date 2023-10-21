<?php

use App\Http\Controllers\Seller\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Seller\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Seller\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Seller\Auth\NewPasswordController;
use App\Http\Controllers\Seller\Auth\PasswordResetLinkController;
use App\Http\Controllers\Seller\Auth\RegisteredUserController;
use App\Http\Controllers\Seller\Auth\VerificationController;
use App\Http\Controllers\Seller\Auth\VerifyEmailController;
use App\Http\Controllers\Seller\RoleController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => ['guest:seller'],'prefix'=>'seller','as'=>'seller.'],function(){
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('seller.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('seller.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('seller.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('seller.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('seller.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('seller.password.store');
//});
Route::get('confirm/page', [AuthenticatedSessionController::class, 'backToReset'])->name('seller.reset.page');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('seller.logout');

Route::group(['middleware' => ['auth:seller']], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('seller.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed:seller', 'throttle:6,1'])
        ->name('seller.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});
Route::post('email/resend', [VerificationController::class, 'resend'])->name('seller.verification.resend');
Route::group(['middleware' => ['auth:seller','verified.seller']], function () {
    Route::get('/home', function () {
        return view('seller.dashboard');
    })->name('seller.dashboard');

    Route::get('/seller_profile', [\App\Http\Controllers\Seller\ProfileController::class, 'edit'])->name('seller.profile.edit');
    Route::post('/update/seller_profile/{id}', [\App\Http\Controllers\Seller\ProfileController::class, 'update_general'])->name('update_general');
    Route::post('/seller_profile/password/{id}', [\App\Http\Controllers\Admin\ProfileController::class, 'update_password'])->name('seller.update.password');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('seller.logout');

    //seller user
    Route::get('/user/list',[SellerController::class,'allUser'])->name('seller.user');
    Route::get('/user/create',[SellerController::class,'userCreate'])->name('seller.user.create');
    Route::post('/user/store',[SellerController::class,'storeSellerUser'])->name('seller.user.store');
    Route::get('/user/edit/{id}', [SellerController::class,'editSellerUser'])->name('seller.user.edit');
    Route::post('/user/update/{id}', [SellerController::class, 'updateSellerUser'])->name('seller.user.update');
    Route::delete('/user/trash/{id}', [SellerController::class,  'trashSellerUser'])->name('seller.user.delete');

    Route::get('/user/deleted', [SellerController::class, 'sellerUserDeleted'])->name('seller-user.deleted');
    Route::delete('/user/delete/{id}', [SellerController::class, 'sellerUserDelete'])->name('seller-user.delete.forever');
    Route::put('/user/restore/{id}', [SellerController::class, 'sellerUserRestore'])->name('seller-user.restore');

    //Role module
    Route::resource('/role', RoleController::class);
});
