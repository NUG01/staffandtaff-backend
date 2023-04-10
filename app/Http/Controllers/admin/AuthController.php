<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class AuthController extends Controller
{
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return response()->json(auth()->user());
        }

        return response()->json('Something went wrong', 401);
    }


    public function admin()
    {

        $user = Auth::user();
        if ($user->role_id == 1) {

            return response()->json(['user' => Auth::user()]);
        }
        return response()->json(['message' => 'Not an admin!'], 401);
    }
}
