<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Subscription;
use Stripe\Stripe;

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
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = $request->user();
        $paymentMethod = $request->payment_method;
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $subscription = $user->newSubscription($request->plan_id, $request->plan);
        $subscription->create($paymentMethod, [
            'email' => $user->email,
        ]);

        return response()->json('Subscribed successfully!');
    }
}
