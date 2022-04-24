<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                $role = Auth::user()->role;

                if ($role == 'estudiante')
                {
                    return redirect()->intended(RouteServiceProvider::ALUMNO);
                } 
                elseif ($role == 'docente'){
                    return redirect()->intended(RouteServiceProvider::PROFE);
                }
                elseif ($role == 'ayudante'){
                    return redirect()->intended(RouteServiceProvider::ALUMNO);
                }
                else{ //es admin
                    return redirect()->intended(RouteServiceProvider::ADMIN);
                }                
            }
            
        }
        return $next($request);
    }
}
