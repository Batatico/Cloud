<?php

namespace App\Http\Controllers;

use App\Models\Contenedor_Asignatura;
use Illuminate\Http\Request;
use App\Imports\Contenedor_AsignaturaImport;
use Excel;
use Error;
class Contenedor_AsignaturaController extends Controller
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
     * @param  \App\Models\Contenedor_Asignatura  $contenedor_Asignatura
     * @return \Illuminate\Http\Response
     */
    public function show(Contenedor_Asignatura $contenedor_Asignatura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contenedor_Asignatura  $contenedor_Asignatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Contenedor_Asignatura $contenedor_Asignatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contenedor_Asignatura  $contenedor_Asignatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contenedor_Asignatura $contenedor_Asignatura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contenedor_Asignatura  $contenedor_Asignatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contenedor_Asignatura $contenedor_Asignatura)
    {
        //
    }

    public function importForm(){
        return view('import-contenedor-asignatura');
    }

    public function import(Request $request)
    {
        try
        {
            try
            {
                Excel::import(new Contenedor_AsignaturaImport,$request->file);// no importa que marque esto como error, aun asi se ejecuta bien
                $datos= Contenedor_Asignatura::all();
                return back()->withStatus('Excel cargado correctamente');
            }
            catch(\Exception $ex)
            {
                return back()->withError('Ocurrió un error, verifique la información del archivo Excel');

            }
        }
        catch(Error $e)
        {
            return back()->withError('Uno o más estudiantes ya tienen inscrita una asignatura del archivo');

        }
        
        
    }

    function desplegarContenedorAsignaturas()
    {
        $datos= Contenedor_Asignatura::all();
        return view('import-contenedor-asignatura', ['contenedor_asignaturas'=>$datos]);
    }
}
