<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContenidoEncuesta;
use App\Http\Controllers\EncuestaController;
use Illuminate\Support\Facades\DB;


class ContenidoEncuestaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $preguntas= ContenidoEncuesta::where('id_encuesta',$id);
        return view('asignatura.Preguntas', ['preguntas'=>$preguntas]);
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
    
        //DEPENDE DE COMO SE ASOCIE CON LA ENCUESTA COMO TAL
        if($request->indicador == null){
            $id_encuesta = $request->id_encuesta;
            $pregunta = ContenidoEncuesta::where('id_encuesta',$id_encuesta)->get();
            return view('asignatura.Preguntas',['preguntas' => $pregunta, 'id_encuesta' =>$id_encuesta])->with('errorMsg','Se necesita indicador para agregar la pregunta.');
        }
        else{
        $encuesta = ContenidoEncuesta::create([
            'id_encuesta'=>$request->id_encuesta,
            'pregunta' => $request->pregunta,
            'indicador' => $request->indicador,
            ]);
    
            $id_encuesta = $encuesta->id_encuesta;
            $pregunta = ContenidoEncuesta::where('id_encuesta',$id_encuesta)->get();
            return view('asignatura.Preguntas',['preguntas' => $pregunta, 'id_encuesta' =>$id_encuesta])->with('successMsg','Se ha creado la pregunta exitosamente.');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_encuesta = $id;
        //$pregunta = ContenidoEncuesta::all();
        $pregunta = ContenidoEncuesta::where('id_encuesta',$id)->get();

        //dd($pregunta);
        return view('asignatura.Preguntas',['preguntas' => $pregunta, 'id_encuesta' => $id_encuesta]);
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
        ContenidoEncuesta::where('id','=',$id)->update($datos);
        $contEncuesta = ContenidoEncuesta::find($id);
        $contEncuesta1= ContenidoEncuesta::all();
        return view('vista asociada', ['vista asociada'=>$contEncuesta1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_encuesta = DB::table('contenido_encuestas')->select('id_encuesta')->where('id_pregunta',$id)->value('id_encuesta');
        $pregunta = ContenidoEncuesta::find($id)->delete();
        

        $contenido= ContenidoEncuesta::where('id_encuesta',$id_encuesta);


//probando xd
            $pregunta = ContenidoEncuesta::where('id_encuesta',$id_encuesta)->get();
            return view('asignatura.Preguntas',['preguntas' => $pregunta, 'id_encuesta' =>$id_encuesta])->with('successMsg','Pregunta elminada exitosamente.');
 



//fin probando xd




        //return redirect()->route('verPreguntas', $id_encuesta);

    }

}
