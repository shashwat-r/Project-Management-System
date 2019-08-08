<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BasicAuth
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
        // authentication works by just creating this middleware
        // using the function given below

        if(Auth::onceBasic()) {
            // Auth::onceBasic is a filter.
            dd('Auth::onceBasic failed');
        }
        return $next($request);
    }
}
