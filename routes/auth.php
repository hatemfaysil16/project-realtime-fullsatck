<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\AdminCotroller;
use App\Http\Controllers\Auth\AdminRegisteredController;



use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'showregister'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'register'])
                ->middleware('guest')
                ->name('register');



Route::get('/login', [AuthenticatedSessionController::class, 'showlogin'])->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'login']);



Route::group([
    'prefix' => 'admin',

], function() {

    Route::middleware('guest')->group(function() {
        // Show Form login admin
        Route::get('login', [AdminCotroller::class, 'showlogin'])->name('login.admin');
        // Request Form login admin
        Route::post('login', [AdminCotroller::class, 'login'])->name('admin.login');
        //show from register admin
        Route::get('register', [AdminRegisteredController::class, 'showregister'])->name('register.admin');
        //Request from register admin
        Route::post('register', [AdminRegisteredController::class, 'register'])->name('register.store.admin');
         // Form logout admin
    });
});

Route::post('admin/logout', [AdminCotroller::class, 'logout'])->name('admin.logout')->middleware('auth:admin');






Route::get('/forgot-password', [PasswordResetLinkController::class, 'showforgot_password'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'forgot_password'])
                ->middleware('guest')
                ->name('password.email');


Route::get('/reset-password/{token}', [NewPasswordController::class, 'showreset_password'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'reset_password'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'verification_notification'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'showconfirm_password'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'confirm_password'])
                ->middleware('auth');












Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
                ->middleware('auth')
                ->name('logout');

