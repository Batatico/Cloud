<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Imports\AsignaturaImport;
use App\Models\PeriodoAcademico;
use Excel;
use Exception;
use Illuminate\Support\Facades\DB;
use Error;


class AsignaturaController extends Controller
{

        

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos= Asignatura::all();
        return view('asignatura.AdministrarAsignatura', ['asignaturas'=>$datos]);
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
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function show(Asignatura $asignatura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignatura = Asignatura::find($id);
        return view('asignatura.form', compact('asignatura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = request()->except(['_token','_method']);
        Asignatura::where('id','=',$id)->update($datos);
        $asignatura = Asignatura::find($id);
        $datos1= Asignatura::all();
        return view('asignatura.AdministrarAsignatura', ['asignaturas'=>$datos1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignatura = Asignatura::find($id);        
        $asignatura->delete();

        return redirect('asignatura');
    }

    public function importForm()
    {
        $datos= Asignatura::all();
        return view('import-asignatura', ['asignaturas'=>$datos]);
    }

    public function import(Request $request)
    {
        try{
            try{

            $pa = DB::table('periodo_academicos')->where('estado', 1)->first();
            $estado = $pa->estado;
    
            if( $estado == 1)
            {
                try
                {
                    Excel::import(new AsignaturaImport,$request->file);// no importa que marque esto como error, aun asi se ejecuta bien
                    $datos= Asignatura::all();
                    return back()->withStatus('Excel cargado correctamente');
                }
                catch(\Exception $ex)
                {
                    return back()->withError('Ocurrió un error, verifique la información del archivo Excel');
                }
    
            }
            else
            {
                return back()->withError('Ocurrió un error, el periodo académico no está activo');
    
            }
        }
        catch(\Exception $ex)
        {
            return back()->withError('Ocurrió un error, el periodo académico no está activo');

        }
        
       }
        catch(Error $e){
            
            return back()->withError('El archivo no se puede subir más de una vez');
        }
        
        
    }

}
