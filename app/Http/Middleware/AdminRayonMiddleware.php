<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminRayonMiddleware
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
        // Level 2 => Rayon
        if(Auth::user()->level > 2){
            return redirect('/home');
        } else {
            return $next($request);
        }
    }
}
