<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function userIntent(): JsonResponse
    {
        $user = User::where('email', auth()->user()->email)->first();
        $stripeData = [
            'intent' => $user->createSetupIntent(),
        ];
        return response()->json(['intent' => $stripeData]);
    }


    public function subscribe(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $user->newSubscription('cash', $request->plan)->create($request->paymentMethod);
        return response()->json('Subscribed successfully!');
    }
}
