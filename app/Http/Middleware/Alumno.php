<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Alumno
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

      if ((Auth::user()->rol=='alumno') || (Auth::user()->rol=='admin') || (Auth::user()->rol=='supervisor')) {

        return $next($request);
      }
     else {
         return redirect('/');
      }

    }
}
