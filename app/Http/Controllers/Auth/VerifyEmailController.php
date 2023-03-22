<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerificationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{

    public function __invoke(VerificationRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->where('verification_code', $request->code)->first();

        if ($user && $user->email_verified_at === null) {
            $user->markEmailAsVerified();
            Auth::login($user);

            return response()->json('Email verified!');
            // event(new Verified($request->user()));
        }

        if ($user && $user->email_verified_at) {
            return response()->json('Email is already verified!', 400);
        }

        return response()->json('Something went wrong', 400);

        // return redirect()->intended(
        //     config('app.frontend_url') . RouteServiceProvider::HOME . '?verified=1'
        // );
    }
}
