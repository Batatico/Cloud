<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Facades\DB;
use Exception;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
       
        //captura el rut del user
        $rut_ingresado = $request->rut;

        //query que revisa si es ayudante el user
        $es_ayudante = DB::table('alumnos')->select('es_ayudante')->where('rut_alumno',$rut_ingresado)->value('es_ayudante');
        
        //query para ver si está habilitado el user
        $estado = DB::table('users')->where('rut', $rut_ingresado)->where('estado',1)->exists();
        
        //query para obtener el rol, aqui se redirecciona
        $role = DB::table('users')->select('role')->where('rut', $rut_ingresado)->value('role');

        if($estado == true){

            $request->authenticate();
            $request->session()->regenerate();
            
            if ($role == 'estudiante' && $es_ayudante == 0)
            {
                return redirect()->intended(RouteServiceProvider::ALUMNO);
            } 
            elseif ($role == 'docente'){
                return redirect()->intended(RouteServiceProvider::PROFE);
            }
            elseif ($role == 'estudiante' && $es_ayudante == 1){
                return redirect()->intended(RouteServiceProvider::AYUDANTE);
            }
            else{ //es admin
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }
        }
        else{
            //NO FUNCIONA LLEVA AL DASHBOARD
            return back()->withError('Ocurrió un error, el usuario no está habilitado.');
        }
    }

       
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
