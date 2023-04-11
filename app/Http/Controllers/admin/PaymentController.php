<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\PaymentResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = DB::table('subscriptions')->get();
        return PaymentResource::collection($payments);
    }
    public function show($id)
    {
        $payment = DB::table('subscriptions')->where('id', $id)->first();
        $paymentData = [
            'owner' => User::where('id', $payment->user_id)->value('name'),
            'name' => $payment->name,
            'status' => $payment->stripe_status,
            'quantity' => $payment->quantity,
        ];
        return response()->json($paymentData);
    }

    public function destroy($id)
    {
        DB::table('subscriptions')->where('stripe_id', $id)->delete();
        return response()->json('Deleted!');
    }
}
