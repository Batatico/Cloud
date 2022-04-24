<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::all();
        return view('usuario.AdministrarUsuarios', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    public function cambiarPass(){

        return view('auth.passwords.cambiarcontraseña');
    }

    public function cambiarP(Request $request){

        $rutData = DB::table('users')->select('password')->where('rut', $request->rut)->value('password'); 

        $dataHash = Hash::check($request->password, $rutData);

        if($dataHash == true){

            return back()->withError('Ocurrió un error, intenta con una clave diferente');

        }
        else{

            if(strlen($request->password) >= 8){

                $user = User::where('rut', $request->rut);
                $user->update(['password'=>Hash::make($request->password)]);
                return back()->withStatus('Contraseña cambiada exitosamente.');
            }
            else{

                return back()->withError('Ocurrió un error, intenta con una clave con un mínimo de 8 caracteres');

            }

            

            
        }

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('usuario.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = request()->except(['_token','_method']);
        User::where('id','=',$id)->update($datos);
        $user = User::find($id);
        //$user->fill($request->all())->save();
        $user1= User::all();
        return view('usuario.AdministrarUsuarios', ['users'=>$user1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find($id);
        if($user->estado == false){

                User::where('id','=',$id)
                ->update(['estado'=> true]);  
                return redirect('usuario');  

        }elseif($user->estado == true){

            User::where('id','=',$id)
            ->update(['estado'=> false]);  
            return redirect('usuario');  

        }else{
            return redirect('usuario'); 
        }
            
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    
    public function reseteo(Request $request, $id){

        $user = User::find($id);
        $rut = Rut::parse($user->rut)->normalize();
        $numero = Rut::parse($user->rut)->number();
        User::where('id','=',$id)->update(['password'=> Hash::make($numero)]);  
        return redirect('usuario');

    }
}
