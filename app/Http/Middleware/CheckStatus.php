<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        //If the status is not active, redirect to the block page
        if(Auth::check() && Auth::user()->status != User::STATUS_ACTIVE){
            Auth::logout();
            return view('block');
        }

        return $response;
    }
}
