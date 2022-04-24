<?php

namespace App\Http\Controllers;

use App\Models\AlumnoEncuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Encuesta;
use App\Models\respuesta;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {

        $periodo_activo = DB::table('periodo_academicos')->where('estado', 1)->exists();

        
        if($periodo_activo == true)
        {
            $rut = Auth::user()->rut;
            $asignatura = DB::table('contenedor_asignaturas')->select('nrc_asignatura')->where('rut_alumno',$rut)->get();
        
            return view('asignatura.EncuestasDisponibles',['asignaturas'=>$asignatura]);
        }
        else //el periodo academico no se encuentra activo
        {
            return back()->withError('Opción no disponible, el periodo académico no se encuentra activo.');
        }
        
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
    public function store(Request $request, $id)
    {


        $rut_ayudante = $request->rut_ayudante;
        $datos = request()->except(['_token','_method','rut_ayudante']);
        $rut_alumno = Auth::user()->rut;
               
        $rut_string = strval($rut_ayudante);

        foreach ($datos as $id_pregunta => $respuesta  ){
            

            respuesta::create([
                'id_encuesta' => $id,
                'id_pregunta' => $id_pregunta,
                'respuesta' => $respuesta,
                'rut_ayudante' => $rut_ayudante,
            ]);
            
            
        }

        AlumnoEncuesta::create([
            'id_encuesta' => $id,
            'rut_alumno' => $rut_alumno,
            'respondida' => true,
            ]);

        return redirect()->route('responder.index')->withSuccess(['La encuesta ha sido respondida exitosamente']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //recibe la nrc
    {
        $id_encuesta = DB::table('encuesta_asignaturas')->select('id_encuesta')->where('nrc_asignatura',$id)->value('id_encuesta');
        $encuesta_activa = DB::table('encuesta_asignaturas')->where('nrc_asignatura',$id)->where('id_encuesta',$id_encuesta)->exists();
        //dd($encuesta_activa);

        if($encuesta_activa == true)
        {
            $rut_alumno = Auth::user()->rut;

            //query por id_encuesta que despliegue preguntas
            $encuesta = Encuesta::find($id_encuesta);
            $preguntas = DB::table('contenido_encuestas')->select('pregunta','indicador', 'id_pregunta')->where('id_encuesta',$id_encuesta)->get();
                
            //query que revisa si la encuesta ya la ha respondido el alumno
            $respondida = DB::table('alumno_encuestas')->select('respondida')->where('rut_alumno',$rut_alumno)->where('id_encuesta',$encuesta->id_encuesta)->value('respondida');
            
            //query que devuelve el rut del ayudante
            $ayudante = DB::table('ayudantes')->join('alumnos','ayudantes.rut_alumno','=','alumnos.rut_alumno')->where('nrc_asignatura',$id)->get();
            
            $hay_ayudante = DB::table('ayudantes')->select('rut_alumno')->where('nrc_asignatura',$id)->exists(); //false

            if($hay_ayudante == true){
                if($respondida == 0)
                {
                    return view('asignatura.ResponderEncuesta',['preguntas' => $preguntas ,'encuesta' => $encuesta,'ayudantes' =>$ayudante]);
                }
                else{ //si la encuesta ya está respondida
                    return back()->withError('Usted ya ha respondida esta encuesta.');
                }
            }
            else{
                return back()->withError('No hay ayudantes asociados a esta encuesta.');

            }
            
        }
        else //si la asignatura no tiene una encuesta activa
        {
            return back()->withError('Asignatura sin encuesta activa.');
        }

        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
