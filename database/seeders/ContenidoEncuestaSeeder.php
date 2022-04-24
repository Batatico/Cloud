<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContenidoEncuesta;
class ContenidoEncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('id_encuesta' => 1,'id_pregunta' => 1 ,'pregunta' => '¿Recomendaría al ayudante?', 'indicador' => 2),
            array('id_encuesta' => 1,'id_pregunta' => 2 ,'pregunta' => 'El ayudante comparte material de calidad', 'indicador' => 1),
          
         ];
        ContenidoEncuesta::insert($data);
    }
}
