<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\Uid\NilUlid;

class VerifyEmailController extends Controller
{

    public function __invoke(Request $request): RedirectResponse
    {
        $user = User::where('confirmation_code', $request->verification_code)->first();

        if ($user && $user->email_verified_at == null) {
            return redirect()->intended(
                config('app.frontend_url') . RouteServiceProvider::HOME . '?verified=1'
            );
        }


        if ($user && $user->email_verified_at) {
            $user->markEmailAsVerified();
            return response()->json('Email verified!');
            event(new Verified($request->user()));
        }

        return redirect()->intended(
            config('app.frontend_url') . RouteServiceProvider::HOME . '?verified=1'
        );
    }
}
