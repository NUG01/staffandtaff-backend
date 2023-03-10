<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\NewPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(NewPasswordRequest $request): JsonResponse
    {
        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user) use ($request) {
        //         $user->forceFill([
        //             'password' => Hash::make($request->password),
        //             'remember_token' => Str::random(60),
        //         ])->save();

        //         event(new PasswordReset($user));
        //     }
        // );

        $passwordResetColumn = DB::table('password_resets')->where([
            ['email', '=', $request->email],
            ['token', '=', $request->token],
            ['created_at', '<=', Carbon::now()->subDays(1)->toDateTimeString()],
        ])->latest()->first();

        if ($passwordResetColumn) {
            $user = User::where('email', $passwordResetColumn->email)->first();
            $user->update([
                'password' => bcrypt($request->password),
            ]);
            DB::table('password_resets')->where('email', $user->email)->delete();
            return response()->json('Password updated!');
        };

        return response()->json('Password can not be updated!', 400);


        // if ($status != Password::PASSWORD_RESET) {
        //     throw ValidationException::withMessages([
        //         'email' => [__($status)],
        //     ]);
        // }

        // return response()->json(['status' => __($status)]);
    }
}
