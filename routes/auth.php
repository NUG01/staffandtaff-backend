<?php

use App\Http\Controllers\Auth\{AuthenticatedSessionController,
    NewPasswordController,
    PasswordResetLinkController,
    RegisteredUserController,
    VerifyEmailController,};
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest')->name('register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest')->name('login');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.store');
    Route::post('/verify-email', VerifyEmailController::class)->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');
});

// Route::post('/forgot-password', fn () => response()->noContent());
// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.odd');
// Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
