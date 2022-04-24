<?php

namespace App\Http\Controllers;

use App\Models\PeriodoAcademico;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PeriodoAcademicoController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodo= PeriodoAcademico::all();
        return view('periodo.AdministrarPeriodo', ['periodos'=>$periodo]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('periodo.AdministrarPeriodo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //ve si hay otro periodo academico habilitado
      $estado = DB::table('periodo_academicos')->select('*')->where('estado', true)->exists(); 

      $codigo = DB::table('periodo_academicos')->select('codigo_semestre')->where('codigo_semestre',$request->codigo_semestre)->exists(); //debería ir en el habilitar

      $varDiez = '10';
      $varVeinte = '20';

      $value = Str::substr($request->codigo_semestre, 4, 2);
      $valueDate = Str::substr($request->codigo_semestre, 0, 4);

      $year = strftime("%Y");
  
      
      
      if($valueDate == $year){

          if($codigo == true){

              return back()->withError('Ocurrió un error, ya existe este semestre');

          }
          else{
         
              if($value == $varDiez || $value == $varVeinte){
  
                  if($estado == false){

                      $periodo = PeriodoAcademico::create([
                      'codigo_semestre' => $request->codigo_semestre,
                      'descripcion' => $request->descripcion,
                      'estado' => true,
                      ]);
              
                      return redirect('periodo');
                  }
                  else{

                      return back()->withError('Ocurrió un error, ya hay un semestre habilitado.');
                  }
                 
              }
              else {
                  return back()->withError('Ocurrió un error, no cumple la regla de código de semestre');  
              }
  
          }
      }
      else {
          return back()->withError('Ocurrió un error, no corresponde al año actual');  
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeriodoAcademico  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show(PeriodoAcademico $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeriodoAcademico $periodo
     * @return \Illuminate\Http\Response
    */

    public function edit($id)
    {
        $periodo = PeriodoAcademico::find($id);
        return view('periodo.form', compact('periodo'));
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeriodoAcademico  $periodo
     * @return \Illuminate\Http\Response
    */

    public function update(Request $request, $id)
    {
        $datos = request()->except(['_token','_method']);
        PeriodoAcademico::where('id','=',$id)->update($datos);
        $periodo = PeriodoAcademico::find($id);
        $periodo1= PeriodoAcademico::all();
        return view('periodo.AdministrarPeriodo', ['periodos'=>$periodo1]);
    }

    public function deshab(Request $request){

        $periodo = PeriodoAcademico::where('codigo_semestre',$request->codigo_semestre)->first();
        if($periodo->estado == true){

                $periodo
                ->update(['estado'=> false]);  
                return redirect('periodo');  

        }else{
            return redirect('periodo');
        }

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeriodoAcademico  $periodo
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
         
        

        
    }

    

}
