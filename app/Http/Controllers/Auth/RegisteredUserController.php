<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Freshwork\ChileanBundle\Rut;
use App\Models\Alumno;
use App\Models\Profesor;
use Illuminate\Support\Facades\DB;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'rut' => 'required|string|max:12|unique:users',

        ]);

        // 1.- ADMINISTRADOR 2.- DOCENTE 3.- ALUMNO (EL ALUMNO AYUDANTE SE DEFINE SOLAMENTE AL CAMBIAR SU ESTADO)

        $habilitado_docente = DB::table('users')->select('*')->where('estado',1)->where('role','docente')->exists(); 

        $rut = Rut::parse($request->rut)->validate();
        $rut = Rut::parse($request->rut)->normalize();
        $numero = Rut::parse($request->rut)->number();

        $user = User::create([
            'rut' => $rut,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($numero),
            'role' =>$request->role,
            'estado' => true,

        ]);

        if($request->role == "estudiante"){

            $estudiante = Alumno::create([
                'rut_alumno' => $rut,
                'correo' => $request->email,
                'nombre' => $request->name,
                'estado' => true,
                'es_ayudante' =>false,
                'password' => Hash::make($numero),
            ]);

            $users= User::all();
            return view('usuario.AdministrarUsuarios', ['users'=>$users]);
        }
        elseif($request->role == "docente"){

            if($habilitado_docente == false){
                $profesor = Profesor::create([
                    'rut_profesor' => $rut,
                    'nombre_profesor' => $request->name,
                    'correo' => $request -> email,
                    'es_encargado' => true,
                    'estado'=> true,
                    'password' => Hash::make($numero),              
                ]);  
                $users= User::all();
                return view('usuario.AdministrarUsuarios', ['users'=>$users]);
            }
            else{
                //NO FUNCIONA EL BACK, LLEVA A DASHBOARD
                return back()->withError('Ocurrió un error, ya hay un encargado docente habilitado.');
            }
            
        }
        else{

            $request->session()->invalidate();
            return redirect('/');
            //aqui hay que desplegar un mensaje de error ... usuario no encontrado
        }

           
       
        
        //event(new Registered($user));

        //Auth::login($user);


       //return redirect(RouteServiceProvider::HOME);
    }
}
