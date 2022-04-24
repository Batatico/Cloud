<?php

namespace App\Http\Controllers;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Models\Encuesta;
use App\Models\ContenidoEncuesta;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\ContenidoEncuestaController;
use Illuminate\Support\Facades\DB;
use App\Models\PeriodoAcademico;




class EncuestaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos= Encuesta::all();
        return view('asignatura.Encuesta', ['encuestas'=>$datos]);
    }

    public function asociar(Request $request){

    //     //dd($request->nrc);
    //     //si no existe es 0, si existe +1
    //     //id encuesta

    //     $nrc_bd = $request->nrc; //correcto

    //     $id_encuesta = DB::table('encuestas')->select('id_encuesta')->where('nrc_asignatura',$nrc_bd)->value('id_encuesta');
    //     //$id_encuesta = Encuesta::select('id_encuesta')->where('nrc_asignatura', $nrc_bd);
    //     //dd($id_encuesta);


    //    // $existe = DB::table('encuestas')->where('nrc_asignatura',$nrc_bd)->exists();
    //     //$existe = DB::table('encuestas')->exists();
    //     $existe = DB::table('encuestas')->count('*');
    //     $varUno = 1;

    //     //dd($existe);

    //     if($existe == 0){

    //         $encuesta = Encuesta::create([

    //         'id_encuesta' => $varUno,
    //         'nombre_encuesta' =>$request->nombre,
    //         'estado' => true,
    //         'nrc_asignatura' => $request->nrc,

    //         ]);
    //     }
    //     else{

    //         $incrementar = $existe+1;

    //         $encuesta = Encuesta::create([

    //         'id_encuesta' => $incrementar,
    //         'nombre_encuesta' =>$request->nombre,
    //         'estado' => true,
    //         'nrc_asignatura' => $request->nrc,

    //         ]);
    //     }


    //     return view('asignatura.AsociarEncuesta', [ 'encuestas' =>$encuesta]);
    }
    



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('añadir vista');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existe = DB::table('encuestas')->select('*')->where('nombre_encuesta',$request->nombre_encuesta)->exists();

        if ($existe == false){
   
            $encuesta = Encuesta::create([
                //id autoincremental
                'nombre_encuesta' => $request->nombre_encuesta,
                'estado' => true,
                ]);
            
            
            $pregunta = ContenidoEncuesta::create([
                'id_encuesta' => $encuesta->id_encuesta,
                'pregunta' => $request->nombre_pregunta,
                'indicador' => $request -> indicador,
                ]);
            

            $datos = Encuesta::all();

            return back()->withStatus('Encuesta creada exitosamente.');
        }
        else{
            return back()->withError('Ya existe una encuesta con ese nombre.');
        }
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
     * @param  int  $id_encuesta
     * @return \Illuminate\Http\Response
     */
    public function edit($id_encuesta)
    {
        $encuesta = Encuesta::find($id_encuesta);
        return view('vista asociada', compact('vista asociada'));
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
        $datos = request()->except(['_token','_method']);
        Encuesta::where('id','=',$id)->update($datos);
        $encuesta = Encuesta::find($id);
        $ecuesta1= Encuesta::all();
        return view('vista asociada', ['vista asociada'=>$encuesta1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_encuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_encuesta)
    {
      
        $encuesta = Encuesta::find($id_encuesta); 
        $encuesta->delete();
        return back()->withStatus('Encuesta eliminada.');
    }
}
