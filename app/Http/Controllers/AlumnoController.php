<?php

namespace App\Http\Controllers;

use App\Imports\AlumnoImport;
use App\Imports\UserImport;
use App\Models\User;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Excel;


class AlumnoController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //qweqwe
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
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //
    }
    public function importForm()
    {
        return view('import-alumno');
    }
    
    public function import(Request $request)
    {
        try{
            Excel::import(new AlumnoImport,$request->file);// no importa que marque esto como error, aun asi se ejecuta bien
            Excel::import(new UserImport,$request->file);
            $datos= Alumno::all();
            return back()->withStatus('Excel cargado correctamente');
        }
        catch(\Exception $ex)
        {
            return back()->withError('Ocurrió un error, verifique la información del archivo Excel');

        }

        
    }

    function desplegarAlumnos()
    {
        $datos= Alumno::all();
        return view('import-alumno', ['alumnos'=>$datos]);
    }

}
