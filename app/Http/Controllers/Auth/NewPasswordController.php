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

        $passwordResetColumn = DB::table('password_resets')->where([
            ['email', '=', $request->email],
            ['token', '=', $request->token],
            // ['created_at', '<=', Carbon::now()->subDays(1)->toDateTimeString()],
        ])->latest()->first();

        if ($passwordResetColumn) {
            $user = User::where('email', $passwordResetColumn->email)->first();
            $user->update([
                'password' => bcrypt($request->password),
            ]);
            DB::table('password_resets')->where('email', $user->email)->delete();
            return response()->json(['message' => 'Password updated!']);
        };

        return response()->json(['error' => 'Password can not be updated!'], 400);
    }
}
