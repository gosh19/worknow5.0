<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class Redireccion
{
    /**
     * Handle an incoming request.
     *REDIRIGE A LA PAGINA DE INICIO DE CADA TIPO DE USUARIO
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Auth::check()) {

        switch (Auth::user()->rol) {
          case 'admin':
            return redirect('/Admin');
            break;
          case 'postventa':
            return redirect('/postventa');
            break;
          case 'desarrollo':
            return redirect('/desarrollo');
            break;
          case 'alumno':
            return redirect('/User/'.Auth::user()->id);
            break;
          case 'vendedor':
            return redirect('/vendedor');
            break;
          case 'supervisor':
            return redirect('/vendedor');
            break;
          default:
            return redirect('/home');
            break;
        }
      }else {
        return redirect()->route('intro');
      }

  }
}
