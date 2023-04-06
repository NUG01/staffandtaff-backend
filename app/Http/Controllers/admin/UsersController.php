<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {

        return UserResource::collection(User::all());
    }
    public function userDetails(User $user)
    {

        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'user',
            'verified' => $user->email_verified_at ? 'true' : 'false',
        ];

        return response()->json($userData);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return UserResource::collection(User::all());
    }
}
