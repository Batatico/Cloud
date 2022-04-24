<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\EncuestaAsignatura;
use Illuminate\Support\Facades\DB;

class EncuestaAsignaturaController extends Controller
{
    public function index()
    {

        $nom_encuesta = Encuesta::get('nombre_encuesta');

        $nrcs = Asignatura::get('nrc');
        return view('asignatura.AsociarEncuesta',['encuestas'=>$nom_encuesta,'asignaturas'=>$nrcs]);
    }

    public function store(Request $request)
    {
        //query que con el nombre de la encuesta busque la id
        $nombre_encuesta = $request->nombre_encuesta;
        $id_encuesta = DB::table('encuestas')->select('id_encuesta')->where('nombre_encuesta',$nombre_encuesta)->value('id_encuesta');
        
        //query que revisa si ya hay una encuesta asociada a la nrc seleccionada
        $existe = DB::table('encuesta_asignaturas')->select('*')->where('id_encuesta',$id_encuesta)->where('nrc_asignatura',$request->nrc_asignatura)->exists();

        //query que revisa que haya sólo una encuesta por asignatura
        $una_encuesta = DB::table('encuesta_asignaturas')->select('*')->where('nrc_asignatura',$request->nrc_asignatura)->exists();
        
        //query que revisa si está habilitado el periodo
        $periodo = DB::table('periodo_academicos')->select('*')->where('estado',1)->exists();
        if($request->nrc_asignatura==null || $request->nombre_encuesta==null)
        {
            return back()->withError('No hay datos para asociar.');
        }
        else{
            if($periodo == true){
                if($una_encuesta == false){
                    if($existe == false){

                        EncuestaAsignatura::create([
                            'nrc_asignatura'=>$request->nrc_asignatura,
                            'id_encuesta'=>$id_encuesta,
                        ]);

                        return back()->withStatus('La encuesta ha sido asociada correctamente.');
                    }
                    else{
                        return back()->withError('La encuesta ya se encuentra asociada a esa asignatura.');
                    }
                }
                else{
                    return back()->withError('La asignatura ya tiene una encuesta asociada.');
                }
            }
            else{
                return back()->withError('El periodo académico no se encuentra habilitado.');
            }
        }
    }

}
