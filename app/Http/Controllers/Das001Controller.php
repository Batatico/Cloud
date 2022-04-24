<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class Das001Controller extends Controller
{
    

    public function cargarGrafico($id_pregunta)
    {
        
        
        $dataIndicador = DB::table('contenido_encuestas')->select('indicador')->where('id_pregunta', $id_pregunta)->value('indicador');
        if($dataIndicador == 2){
            
            $_dataYes_ = DB::table('respuestas')->where('respuesta','Si')->where('id_pregunta', $id_pregunta)->select('*')->count('*');
            $_dataNo_ = DB::table('respuestas')->where('respuesta','No')->where('id_pregunta', $id_pregunta)->select('*')->count('*');


            $dataQuestion = DB::table('contenido_encuestas')->select('pregunta')->where('id_pregunta',$id_pregunta)->value('pregunta');

            $puntos[] = ['name' => 'Si', 'y' => $_dataYes_];
            $puntos[] = ['name' => 'No', 'y' => $_dataNo_];

            $preguntaVista[] = [$dataQuestion];
            
            return view("graficoayudante", ["data" => json_encode($puntos), "series" => json_encode($preguntaVista)]);

        }else
        {
            
            $dataAcuerdo = DB::table('respuestas')->where('respuesta', 'De acuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');
            $dataTotalAc = DB::table('respuestas')->where('respuesta', 'Totalmente de acuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

            $dataDesa = DB::table('respuestas')->where('respuesta', 'Desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');
            $dataTotalDesa = DB::table('respuestas')->where('respuesta', 'Totalmente en desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

            $dataNoApply = DB::table('respuestas')->where('respuesta', 'Ni de acuerdo ni en desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

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
    //PARA CARGAR LOS GRAFICOS DE DAS-001 PARTE 4
    public function DesplegarPreguntas($nrc)
    {
        $tiene_encuestas_asociadas =  DB::table('encuesta_asignaturas')->join('contenido_encuestas','encuesta_asignaturas.id_encuesta','=','contenido_encuestas.id_encuesta')->where('encuesta_asignaturas.nrc_asignatura',$nrc)->exists();

        if($tiene_encuestas_asociadas)
        {
            $idencuesta_por_nrc = DB::table('encuesta_asignaturas')->select('id_encuesta')->where('nrc_asignatura',$nrc)->value('id_encuesta');
            $preguntas = DB::table('contenido_encuestas')->select('id_pregunta','pregunta')->where('id_encuesta',$idencuesta_por_nrc)->get();

            return view ('desplegarPreguntasDas',['preguntas' => $preguntas]);
        }
        else{
            return back()->withError('Ocurrió un error, la asignatura no tiene encuestas asociadas.');

        }
        
    }


    //Ayudantes

    public function cargarGraficoAyudantes($id_pregunta, $nrc) //nrc
    {
        
        $rutAyudante = DB::table('ayudantes')->select('rut_alumno')->where('nrc_asignatura',$nrc)->value('rut_alumno');
        
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


    public function DesplegarPreguntasAyudantes($nrc)
    { 

        $idencuesta_por_nrc = DB::table('encuesta_asignaturas')->select('id_encuesta')->where('nrc_asignatura',$nrc)->value('id_encuesta');
        $preguntas = DB::table('contenido_encuestas')->select('id_pregunta','pregunta')->where('id_encuesta',$idencuesta_por_nrc)->get();
        

        return view ('PreguntasAsociadasDas',['encuestas' => $preguntas, 'nrcs' => $nrc]);
    }

    public function entregaListasAyudantes($rut_ayudante){

        $nrc= DB::table('ayudantes')->select('nrc_asignatura')->where('rut_alumno',$rut_ayudante)->value('nrc_asignatura');
        $asignaturas = DB::table('asignaturas')->select('nrc','codigo_asignatura')->where('nrc',$nrc);
        dd($asignaturas);
        
        return view("usuario.graficos", ["asignaturas" => $asignaturas]);

    }

    public function seleccionDas($rut_ayudante)
    {  
             
       $id_encuesta = DB::table('ayudantes')->join('encuesta_asignaturas', 'ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->select('encuesta_asignaturas.id_encuesta')->where('ayudantes.rut_alumno', $rut_ayudante)->value('encuesta_asignaturas.id_encuesta');

       $tiene_encuestas = DB::table('ayudantes')->join('encuesta_asignaturas', 'ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->join('contenido_encuestas','encuesta_asignaturas.id_encuesta','=','contenido_encuestas.id_encuesta')->select('contenido_encuestas.id_encuesta')->where('contenido_encuestas.id_encuesta',$id_encuesta)->exists();
       //dd($tiene_encuestas);
       if($tiene_encuestas == true)
       {
            $asignatura_ayudante = DB::table('ayudantes')->join('encuesta_asignaturas', 'ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->join('encuestas','encuesta_asignaturas.id_encuesta','=','encuestas.id_encuesta')->select('ayudantes.nrc_asignatura')->where('estado',1)->where('rut_alumno', $rut_ayudante)->get();
            return view('usuario.seleccionarAsignaturaDas',['encuestas' => $asignatura_ayudante ]);

       }
       else
       {
            return back()->withError('Ocurrió un error, el ayudante no tiene ayudantías inscritas.');

            //$status = 'Successfully Done';
            //return back()->with(['status' => $status]);
       }




    }

    //DAS 6

    public function cargarPeriodos($rut)
    {
        $tienePeriodos = DB::table('ayudantes')->join('encuesta_asignaturas','ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->join('asignaturas','encuesta_asignaturas.nrc_asignatura','=','asignaturas.nrc')->join('periodo_academicos','asignaturas.periodo_academico','=','periodo_academicos.codigo_semestre')->where('ayudantes.rut_alumno',$rut)->select('periodo_academicos.codigo_semestre')->distinct()->exists();


        if($tienePeriodos){

            $periodos = DB::table('ayudantes')->join('encuesta_asignaturas','ayudantes.nrc_asignatura','=','encuesta_asignaturas.nrc_asignatura')->join('asignaturas','encuesta_asignaturas.nrc_asignatura','=','asignaturas.nrc')->join('periodo_academicos','asignaturas.periodo_academico','=','periodo_academicos.codigo_semestre')->where('ayudantes.rut_alumno',$rut)->select('periodo_academicos.codigo_semestre')->distinct()->get();
    
            return view('d6SeleccionarPeriodo', ['periodos' => $periodos]);
        }
        else{

            return back()->withError('Ocurrió un error, el ayudante no lo ha sido en periodos anteriores.');

        }
        
    }

    public function cargarEncuestas($periodo){

       
        $encuestas = DB::table('encuesta_asignaturas')->join('asignaturas','encuesta_asignaturas.nrc_asignatura','=','asignaturas.nrc')->join('respuestas','encuesta_asignaturas.id_encuesta','=','respuestas.id_encuesta')->where('asignaturas.periodo_academico',$periodo)->select('respuestas.id_encuesta')->distinct()->get();
        //dd($encuestas);
        return view('d6EncuestaPeriodo',['encuestas' => $encuestas]);
    }

    public function cargarPreguntas($id_encuesta){

        
        $preguntas = DB::table('contenido_encuestas')->select('id_pregunta','pregunta')->where('id_encuesta',$id_encuesta)->get();


        return view ('d6Preguntas',['encuestas' => $preguntas]);

    }

    public function ConsolidadoGrafica($id_pregunta){

    //pregunta de una encuesta de una asignatura
    $dataIndicador = DB::table('contenido_encuestas')->select('indicador')->where('id_pregunta', $id_pregunta)->value('indicador');
    if($dataIndicador == 2){
        
        $_dataYes_ = DB::table('respuestas')->where('respuesta','Si')->where('id_pregunta', $id_pregunta)->select('*')->count('*');
        $_dataNo_ = DB::table('respuestas')->where('respuesta','No')->where('id_pregunta', $id_pregunta)->select('*')->count('*');


        $dataQuestion = DB::table('contenido_encuestas')->select('pregunta')->where('id_pregunta',$id_pregunta)->value('pregunta');

        $puntos[] = ['name' => 'Si', 'y' => $_dataYes_];
        $puntos[] = ['name' => 'No', 'y' => $_dataNo_];

        $preguntaVista[] = [$dataQuestion];
        
        return view("graficoayudante", ["data" => json_encode($puntos), "series" => json_encode($preguntaVista)]);

    }else
    {
        
        $dataAcuerdo = DB::table('respuestas')->where('respuesta', 'De acuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');
        $dataTotalAc = DB::table('respuestas')->where('respuesta', 'Totalmente de acuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

        $dataDesa = DB::table('respuestas')->where('respuesta', 'Desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');
        $dataTotalDesa = DB::table('respuestas')->where('respuesta', 'Totalmente en desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

        $dataNoApply = DB::table('respuestas')->where('respuesta', 'Ni de acuerdo ni en desacuerdo')->where('id_pregunta',$id_pregunta)->select('*')->count('*');

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
    
        
    



}
