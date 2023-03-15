<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class MustBeSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param string plan
     */
    public function handle(Request $request, Closure $next, $plan = null): Response
    {
        $subscription = null;
        $subscription = DB::table('subscriptions')->where([
            ['user_id', '=', auth()->user()->id],
            ['stripe_status', '=', 'active'],
        ])->latest()->first();

        if ($subscription != null && $subscription->name == $plan) {
            return $next($request);
        }

        return redirect(config('app.frontend_url') . RouteServiceProvider::HOME);
    }
}
