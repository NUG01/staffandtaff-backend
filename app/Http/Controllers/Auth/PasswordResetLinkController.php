<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);


        $user = User::where('email', $request->email)->first();
        $token = Str::random(32);
        $url = config('app.frontend_url') . '/forgot-password/?token=' . $token . '&email=' . $user->email;
        if ($user) {
            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            MailController::sendPasswordResetEmail($user->name, $user->email, $url);
            return response()->json(['message' => 'Email sent!']);
        }

        return response()->json(['error' => 'Email can not be sent!'], 400);
    }
}
