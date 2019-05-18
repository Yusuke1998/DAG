<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->type=='administrador') {
            return $next($request);

        }else{

        	return redirect(route('dashboard'));
        }
    }
}
