<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Desarrollo
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
      if ((Auth::user()->rol=='desarrollo') || (Auth::user()->rol=='admin') ) {
        return $next($request);

     }else {
         return redirect('login');
      }
    }
}
