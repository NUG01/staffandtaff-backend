<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\UserResource;
use App\Models\Establishment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {

        return UserResource::collection(User::all());
    }
    public function show()
    {

        $user = Auth::user();

        $userData = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        return response()->json($userData);
    }
    public function updateAdmin(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);


        Auth::user()->update([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
        ]);

        return response()->json(['message' => 'Updated successfully!']);
    }
    public function userDetails(User $user)
    {

        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $this->role($user->role_id),
            'verified' => $user->email_verified_at ? 'true' : 'false',
        ];

        return response()->json($userData);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return UserResource::collection(User::all());
    }
    public function update(Request $request)
    {

        $credentials = $request->validate([
            'id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        $user = User::find($credentials['id']);
        $user->update([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
        ]);
        return response()->json(['message' => 'Updated successfully!']);
    }

    public static function role($id)
    {
        if ($id == 1) return 'admin';
        if ($id == 2) return 'recruiter';
        if ($id == 3) return 'seeker';
    }
}
