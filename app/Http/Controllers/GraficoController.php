<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\AlumnoEncuesta;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    public function index(){

        //QUERY ASOCIADA A LA OBTENCIÓN DE CUENTAS

        $totalEncuestasResp = DB::table('alumno_encuestas')->where('respondida',1)->count('*'); 
        $totalEncuestas = DB::table('alumnos')->count('*');
        $resultadoResta = $totalEncuestas - $totalEncuestasResp;

        //For de grafico 1
        for ($i=0; $i < 2; $i++) 
        { 
            if($i == 0)
            {
                $puntos[] = ['name' => 'Encuestas respondidas', 'y' => $totalEncuestasResp];
            }
            else
            {
                $puntos[] = ['name' => 'Encuestas restantes', 'y' => $resultadoResta];
            }
                
        }

        $cantidad_Encuestas = DB::table('encuesta_asignaturas')->count('*');
        //codigo del grafico 2 ASIGNATURAS SIN ENCUESTA ACTIVA
        
        if($cantidad_Encuestas==0)
        {
            $nrc_encuesta2[] = ['no hay asignaturas que cumplan la condición'];
        }else{
     
            $nrc_encuesta2 = DB::table('encuesta_asignaturas')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->select('encuesta_asignaturas.nrc_asignatura')->where('encuestas.estado',0)->get();
      

        }


        //Codigo del grafico 3 Asignaturas con encuesta activa sin respuesta
        if($cantidad_Encuestas==0)
        {
            $nrc_encuesta3 = ['no hay asignaturas que cumplan la condición'];
        }
        else{
            $nrc_encuesta3 = DB::table('encuesta_asignaturas')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->select('encuesta_asignaturas.nrc_asignatura')->where('encuestas.estado',1)->whereNotIn('encuestas.id_encuesta',DB::table('respuestas')->select('id_encuesta'))->get();

        }

        $nrc_encuesta4 = DB::table('asignaturas')->select('nrc')->get();

        $ayudantes_encuesta5 = DB::table('alumnos')->select('*')->where('es_ayudante',1)->get();
            
            

        return view("usuario.graficos", ["data" => json_encode($puntos), 'data2'=>$nrc_encuesta2, 'data3'=>$nrc_encuesta3, 'data4' => $nrc_encuesta4, 'data5' => $ayudantes_encuesta5]);

        //dd($puntos3);

       






        // //For de grafico 3 Asignaturas con encuestas activas sin respuesta
        // for ($i=1; $i < $cantidad_Encuestas + 1; $i++) 
        // { 
        //     //comprobar si la encuesta actual ($i) tiene encuestas activas
        //     $activa = DB::table('encuesta_asignaturas')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->join('alumno_encuestas','encuestas.id_encuesta','=','alumno_encuestas.id_encuesta')->select('encuesta_asignaturas.nrc_asignatura')->where('encuestas.estado',1)->where('encuesta_asignaturas.id_encuesta',$i)->exists();
        //     if($activa)
        //     {
        //         //comprobar si la encuesta no tiene respuestas
        //         $no_tiene_respuestas = DB::table('encuesta_asignaturas')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->join('alumno_encuestas','encuestas.id_encuesta','=','alumno_encuestas.id_encuesta')->select('encuesta_asignaturas.nrc_asignatura')->where('encuestas.estado',1)->where('alumno_encuestas.respondida',0)->where('encuesta_asignaturas.id_encuesta',$i)->exists();

        //         if(!$no_tiene_respuestas)//si tiene respuestas
        //         {

        //             $nrc_encuesta = DB::table('encuesta_asignaturas')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->join('alumno_encuestas','encuestas.id_encuesta','=','alumno_encuestas.id_encuesta')->select('encuesta_asignaturas.nrc_asignatura')->where('encuestas.estado',1)->where('alumno_encuestas.respondida',1)->where('encuesta_asignaturas.id_encuesta',$i)->value('nrc_asignatura');
                    
        //             $puntos3[] = [$nrc_encuesta, 0];
        //         }
        //         else
        //         {
        //             $nrc_encuesta = DB::table('encuesta_asignaturas')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->join('alumno_encuestas','encuestas.id_encuesta','=','alumno_encuestas.id_encuesta')->select('encuesta_asignaturas.nrc_asignatura')->where('encuestas.estado',1)->where('alumno_encuestas.respondida',0)->where('encuesta_asignaturas.id_encuesta',$i)->value('nrc_asignatura');
                    
        //             //$cantidad_inactiva = DB::table('encuesta_asignaturas')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->join('alumno_encuestas','encuestas.id_encuesta','=','alumno_encuestas.id_encuesta')->select('encuesta_asignaturas.nrc_asignatura')->where('encuestas.estado',1)->where('alumno_encuestas.respondida',0)->where('encuesta_asignaturas.id_encuesta',$i)->count('*');
        //             if($nrc_encuesta != null)
        //             {
        //                 $puntos3[] = [$nrc_encuesta, $cantidad_inactiva];

        //             }
                
        //         }
        //     }
        //     else//la asignatura tiene una encuesta que no está activa
        //     {
        //         $nrc_encuesta = DB::table('encuesta_asignaturas')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->join('alumno_encuestas','encuestas.id_encuesta','=','alumno_encuestas.id_encuesta')->select('encuesta_asignaturas.nrc_asignatura')->where('encuestas.estado',0)->where('encuesta_asignaturas.id_encuesta',$i)->value('nrc_asignatura');
                    
        //         $puntos3[] = [$nrc_encuesta, 1];
        //     }
            
                       
               
        // }
    }

    public function entregaListas($nrc){

        
        $asignaturas = DB::table('asignaturas')->select('nrc','codigo_asignatura')->where('nrc',$nrc);
        dd($asignaturas);
        
        return view("usuario.graficos", ["asignaturas" => $asignaturas]);

    }
    
}
