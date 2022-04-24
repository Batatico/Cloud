<?php

namespace App\Http\Controllers;

use App\Models\Ayudante;
use Illuminate\Http\Request;
use App\Imports\AyudanteImport;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use App\Models\Encuesta;
use Excel;
use Error;

class AyudanteController extends Controller
{

    
    
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         //
     }
     public function seleccion()
     {  
        $user = auth()->user(); // Retrieve the currently authenticated user...
        $id = auth()->id();
        
        $rutAyudante = DB::table('users')->select('rut')->where('id',$id)->value('rut');
        $tiene_ayudantias = DB::table('ayudantes')->join('encuesta_asignaturas', 'ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->select('ayudantes.nrc_asignatura')->where('encuestas.estado',1)->where('ayudantes.rut_alumno', $rutAyudante)->exists();
        if($tiene_ayudantias)
       {

            $id_encuesta = DB::table('ayudantes')->join('encuesta_asignaturas', 'ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->select('encuesta_asignaturas.id_encuesta')->where('ayudantes.rut_alumno', $rutAyudante)->value('encuesta_asignaturas.id_encuesta');

            $tiene_encuestas = DB::table('ayudantes')->join('encuesta_asignaturas', 'ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->join('contenido_encuestas','encuesta_asignaturas.id_encuesta','=','contenido_encuestas.id_encuesta')->select('contenido_encuestas.id_encuesta')->where('contenido_encuestas.id_encuesta',$id_encuesta)->exists();
            if($tiene_encuestas)
            {
                $asignatura_ayudante = DB::table('ayudantes')->join('encuesta_asignaturas', 'ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->select('ayudantes.nrc_asignatura')->where('estado',1)->where('rut_alumno', $rutAyudante)->get();
                return view('usuario.seleccionarAsignatura',['encuestas' => $asignatura_ayudante ]);
    
            }
           else{
            return back()->withError('La asignatura no tiene encuestas actualmente.');
           }
        
       }
       else{
        return back()->withError('Usted no tiene ayudantias asociadas este semestre.');
       }
        //rene
        
     }
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //
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
      * @param  \App\Models\Ayudante  $asignatura
      * @return \Illuminate\Http\Response
      */
     public function show(Ayudante $ayudante)
     {
         //
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\Ayudante $asignatura
      * @return \Illuminate\Http\Response
      */
     public function edit(Ayudante $ayudante)
     {
         //
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Models\Ayudante  $asignatura
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, Ayudante $ayudante)
     {
         //
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\Ayudante $asignatura
      * @return \Illuminate\Http\Response
      */
     public function destroy(Ayudante $ayudante)
     {
         //
     }
 
    public function importForm(){
        return view('import-ayudante');
    }

    public function import(Request $request)
    {
        
        // Excel::import(new AyudanteImport,$request->file);// no importa que marque esto como error, aun asi se ejecuta bien
        // $datos= Ayudante::all();
        // return back()->withStatus('Excel cargado correctamente');
        
       
        try
        {
              
            try
            {
                Excel::import(new AyudanteImport,$request->file);// no importa que marque esto como error, aun asi se ejecuta bien
                $datos= Ayudante::all();
                return back()->withStatus('Excel cargado correctamente');
            }
            catch(\Exception $ex)
            {
                return back()->withError('Ocurrió un error, verifique la información del archivo Excel');
    
            }
        }
        catch(Error $e)
        {
            return back()->withError('Uno o más ayudantes del archivo ya fueron asignados a una asignatura');

        }
       
        
    }

    public function desplegarAyudantes()
    {
        $datos= Ayudante::all();
        return view('import-ayudante', ['ayudantes'=>$datos]);
    }

    public function SeleccionarAsignatura()
    {
        $datos= Ayudante::all();
        return view('import-ayudante', ['ayudantes'=>$datos]);
    }
    
}
