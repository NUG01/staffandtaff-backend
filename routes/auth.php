<?php

use App\Http\Controllers\Auth\{
    AuthenticatedSessionController,
    NewPasswordController,
    PasswordResetLinkController,
    RegisteredUserController,
    VerifyEmailController,
};
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/recruiter-register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
    Route::post('/reset-password', [NewPasswordController::class, 'store']);
});
Route::post('/verify-email', VerifyEmailController::class)->middleware(['auth', 'signed', 'throttle:6,1']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

// Route::post('/forgot-password', fn () => response()->noContent());
// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.odd');
// Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
