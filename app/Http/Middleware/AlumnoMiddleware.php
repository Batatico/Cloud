<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlumnoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $rut_alumno = Auth::user()->rut;
        //Esta query revisa si el alumno que ingreso es ayudante
        $es_ayudante = DB::table('alumnos')->select('es_ayudante')->where('rut_alumno',$rut_alumno)->value('es_ayudante');

        if(Auth::check() && Auth::user()->role=='docente'){
            return redirect('/docente-home'); //redirigr al home de docente
        }
        elseif(Auth::check() && Auth::user()->role=='estudiante' && $es_ayudante==0){
            return $next($request);
        }
        elseif(Auth::check() && Auth::user()->role=='estudiante' && $es_ayudante==1){ 
            return redirect('/Ayudante-home');
        }
        elseif(Auth::check() && Auth::user()->role=='admin'){
            return $next($request);
        }
        else{
            return redirect('/');
        }      
    }
}
