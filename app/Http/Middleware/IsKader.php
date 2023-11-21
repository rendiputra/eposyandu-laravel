<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsKader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @var role : 1 => UserNormal, 2 => Kader, 3 => KaDes, 4 => Admin
     */
    public function handle(Request $request, Closure $next)
    {
        if((Auth::check() && Auth::user()->role == 2) || Auth::user()->role == 4){
            return $next($request);
        }else{
            return abort(404);
        }
    }
}
