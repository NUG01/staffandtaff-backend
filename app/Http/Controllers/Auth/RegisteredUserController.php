<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): JsonResponse
    {

        $token = sha1(time());
        $user = User::create([
            'name' => 'recruiter_' . mt_rand(1000000, 9999999),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $token
        ]);
        //  return response()->json('ok');
        // event(new Registered($user));
        auth()->login($user);
        if ($user) {
            $url = config('app.frontend_url') . '/email-confirmation/' . '/email=' . $user->email . '&token=' . $token;
            MailController::sendVerificationEmail($user->name, $user->email, $url);
            return response()->json('Email sent!');
        }

        return response()->json('Email can not be sent!');
    }
}
