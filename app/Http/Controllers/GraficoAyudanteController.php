<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ayudante;
use App\Models\ContenidoEncuesta;


class GraficoAyudanteController extends Controller
{
    public function index($id_pregunta)
    {
        
        //Se obtiene el rut de sesión

        $user = auth()->user();
        $id = auth()->id();
        
        $rutAyudante = DB::table('users')->select('rut')->where('id',$id)->value('rut');
        $asignatura_ayudante = DB::table('ayudantes')->select('nrc_asignatura')->where('rut_alumno', $rutAyudante)->get();
        $array_asignatura = json_decode(json_encode($asignatura_ayudante), true);
        //dd($array_asignatura[0]);
        
        //$asignatura_encuestaID = DB::table('encuesta_asignaturas')->select('id_encuesta')->where('nrc_asignatura',$asignatura_ayudante)->value('id_encuesta');

            //AGREGAR IF PARA LA CONTENCION DE ERROR DE ENCUESTA ACTIVA - ESTA QUERY ENTREGA EL ESTADO
        //$encuesta_activaID = DB::table('encuestas')->select('estado')->where('id_encuesta',$asignatura_encuestaID)->value('estado');

        //VERIFICA ESTADO DENTRO DE LA QUERY
        //$encuesta_activaID = DB::table('encuestas')->select('id_encuesta')->where('id_encuesta',$asignatura_encuestaID)->where('estado',1)->value('id_encuesta');

        //VERIFICAR SI EL ESTUDIANTE ES AYUDANTE
        $rolEstudiante = 'estudiante'; 
        $role_ayudante = DB::table('users')->select('role')->where('rut',$rutAyudante)->value('role');
        $bitAyudante = DB::table('alumnos')->select('es_ayudante')->where('rut_alumno',$rutAyudante)->value('es_ayudante');

        //VERIFICA SI EL AYUDANTE ES AYUDANTE COMO TAL -> AQUI ESTA COMO DOCENTE PORQUE SON DATOS DE PRUEBA
        if($role_ayudante == $rolEstudiante && $bitAyudante == 1)
        {
            $cantidad_asignaturas = DB::table('ayudantes')->select('nrc_asignatura')->where('rut_alumno', $rutAyudante)->count();

            //VERIFICA SI EL AYUDANTE TIENE AYUDANTIAS ASOCIADAS
            if($cantidad_asignaturas < 1) 
            {
                return back()->withError('Ocurrió un error, usted no tiene ayudantias asociadas este semestre');     
            }
            else
            {
                $respuesta_existentePorID = DB::table('respuestas')->where('id_encuesta',1)->count('*');
                if($respuesta_existentePorID < 1)
                {
                    return back()->withError('La encuesta no cuenta con respuestas aún');   
                }
                else
                {
                    //DESDE EN ADELANTE EMPIEZA A FUNCIONAR LA MUESTRA DE GRAFICOS EN LA VISTA, HASTA AQUÍ TENIAMOS AYER 

                    $counterPregunta = DB::table('contenido_encuestas')->count('*');

                    //VERIFICAR CICLO FOR
                    for ($i=1; $i < $counterPregunta + 1; $i++) 
                    { 

                        //QUERYS DUPLICADAS DE PRUEBA
                        //$dataIndicador = DB::table('contenido_encuestas')->select('indicador')->where('id_pregunta', $id_pregunta)->value('indicador');

                        $dataIndicador = DB::table('contenido_encuestas')->select('indicador')->where('id_pregunta', $i)->value('indicador');
                        $dataId = DB::table('contenido_encuestas')->select('id_encuesta')->where('id_pregunta',$i)->where('indicador',$dataIndicador)->value('id_encuesta');
                        if($dataIndicador == 2){
                            $dataYes = DB::table('respuestas')->where('respuesta','Si')->where('id_encuesta', $dataId)->count('*');
                            $dataNo = DB::table('respuestas')->where('respuesta','No')->where('id_encuesta', $dataId)->count('*');
                            //dd($dataYes);
                            $dataQuestion = DB::table('contenido_encuestas')->select('pregunta')->where('id_pregunta',$i)->where('indicador',$dataIndicador)->value('pregunta');

                            $puntos[] = ['name' => 'Si', 'y' => $dataYes];
                            $puntos[] = ['name' => 'No', 'y' => $dataNo];

                            $preguntaVista[] = [$dataQuestion];
                            $graficos[] = ['data' => $puntos, 'series' => $preguntaVista];
                            
                            //return view("graficoayudante", ["graficos" => ($graficos)]);
                            return view("graficoayudante", ["data" => json_encode($puntos), "series" => json_encode($preguntaVista)]);

                        }else
                        {
                            
                            $dataAcuerdo = DB::table('respuestas')->where('respuesta', 'De acuerdo')->where('id_encuesta',$dataId)->where('id_pregunta',$i)->count('*');
                            $dataTotalAc = DB::table('respuestas')->where('respuesta', 'Totalmente de acuerdo')->where('id_encuesta',$dataId)->where('id_pregunta',$i)->count('*');

                            $dataDesa = DB::table('respuestas')->where('respuesta', 'Desacuerdo')->where('id_encuesta',$dataId)->where('id_pregunta',$i)->count('*');
                            $dataTotalDesa = DB::table('respuestas')->where('respuesta', 'Totalmente en desacuerdo')->where('id_encuesta',$dataId)->where('id_pregunta',$i)->count('*');

                            $dataNoApply = DB::table('respuestas')->where('respuesta', 'Ni de acuerdo ni en desacuerdo')->where('id_encuesta',$dataId)->where('id_pregunta',$i)->count('*');

                            $dataQuestion2 = DB::table('contenido_encuestas')->select('pregunta')->where('id_pregunta',$i)->where('indicador',$dataIndicador)->value('pregunta');

                            $puntos[] = ['name' => "De acuerdo", 'y' => $dataAcuerdo];
                            $puntos[] = ['name' => "Totalmente de acuerdo", 'y' => $dataTotalAc];
                            $puntos[] = ['name' => "Desacuerdo", 'y' => $dataDesa];
                            $puntos[] = ['name' => "Totalmente en desacuerdo", 'y' => $dataTotalDesa];
                            $puntos[] = ['name' => "Ni de acuerdo ni en desacuerdo", 'y' => $dataNoApply];

                            $preguntaVista2[] = [$dataQuestion2];

                            return view("graficoayudante", ["data" => json_encode($puntos), "series" => json_encode($preguntaVista2)]);

                        }
        
            
                    }
                }
                
            }
           
        }
        else
        {
            return back()->withError('Permiso a gráficos denegado, usted no es ayudante'); 
        }   

    }

    
    public function cargarGrafico($id_pregunta)
    {
        $user = auth()->user(); // Retrieve the currently authenticated user...
        $id = auth()->id();
        
        $rutAyudante = DB::table('users')->select('rut')->where('id',$id)->value('rut');
        $dataIndicador = DB::table('contenido_encuestas')->select('indicador')->where('id_pregunta', $id_pregunta)->value('indicador');
        if($dataIndicador == 2){
            
            $_dataYes_ = DB::table('respuestas')->where('respuestas.rut_ayudante',$rutAyudante)->where('respuesta','Si')->where('id_pregunta', $id_pregunta)->select('*')->count('*');
            $_dataNo_ = DB::table('respuestas')->where('respuestas.rut_ayudante',$rutAyudante)->where('respuesta','No')->where('id_pregunta', $id_pregunta)->select('*')->count('*');


            $dataQuestion = DB::table('contenido_encuestas')->select('pregunta')->where('id_pregunta',$id_pregunta)->value('pregunta');

            $puntos[] = ['name' => 'Si', 'y' => $_dataYes_];
            $puntos[] = ['name' => 'No', 'y' => $_dataNo_];

            $preguntaVista[] = [$dataQuestion];
            
            return view("graficoayudante", ["data" => json_encode($puntos), "series" => json_encode($preguntaVista)]);

        }else
        {
            
            $dataAcuerdo = DB::table('respuestas')->where('respuestas.rut_ayudante',$rutAyudante)->where('respuesta', 'De acuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');
            $dataTotalAc = DB::table('respuestas')->where('respuestas.rut_ayudante',$rutAyudante)->where('respuesta', 'Totalmente de acuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

            $dataDesa = DB::table('respuestas')->where('respuestas.rut_ayudante',$rutAyudante)->where('respuesta', 'Desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');
            $dataTotalDesa = DB::table('respuestas')->where('respuestas.rut_ayudante',$rutAyudante)->where('respuesta', 'Totalmente en desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

            $dataNoApply = DB::table('respuestas')->where('respuestas.rut_ayudante',$rutAyudante)->where('respuesta', 'Ni de acuerdo ni en desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

            $dataQuestion2 = DB::table('contenido_encuestas')->select('pregunta')->where('id_pregunta',$id_pregunta)->value('pregunta');

            $puntos[] = ['name' => "De acuerdo", 'y' => $dataAcuerdo];
            $puntos[] = ['name' => "Totalmente de acuerdo", 'y' => $dataTotalAc];
            $puntos[] = ['name' => "Desacuerdo", 'y' => $dataDesa];
            $puntos[] = ['name' => "Totalmente en desacuerdo", 'y' => $dataTotalDesa];
            $puntos[] = ['name' => "Ni de acuerdo ni en desacuerdo", 'y' => $dataNoApply];

            $preguntaVista2[] = [$dataQuestion2];

            return view("graficoayudante", ["data" => json_encode($puntos), "series" => json_encode($preguntaVista2)]);

        }


        
    }
    public function DesplegarPreguntas($nrc){


        $idencuesta_por_nrc = DB::table('encuesta_asignaturas')->select('id_encuesta')->where('nrc_asignatura',$nrc)->value('id_encuesta');
        //dd($idencuesta_por_nrc);
        $preguntas = DB::table('contenido_encuestas')->select('id_pregunta','pregunta')->where('id_encuesta',$idencuesta_por_nrc)->get();


        return view ('PreguntasAsociadas',['encuestas' => $preguntas]);
    }
}
