<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function userIntent(Request $request): JsonResponse
    {
        // $user = User::where('email', $request->email)->first();
        // $user = new User();
        $stripeData = [
            'intent' => $request->user->createSetupIntent(),
        ];
        return response()->json($stripeData);
    }


    public function store(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $user->newSubscription('cash', $request->plan)->create($request->paymentMethod);
        return response()->json('Subscribed successfully!');
    }
}
