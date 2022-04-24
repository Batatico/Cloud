<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Encuesta;
class EncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('id_encuesta' => 1,'nombre_encuesta' => 'Aprendizaje Esperado' ,'estado' => 1),
            array('id_encuesta' => 2,'nombre_encuesta' => 'Valoración Profesor' ,'estado' => 1),
            array('id_encuesta' => 3,'nombre_encuesta' => 'Valoración Ayudante' ,'estado' => 0),
            array('id_encuesta' => 4,'nombre_encuesta' => 'Aprendizaje Esperado' ,'estado' => 0),
            array('id_encuesta' => 5,'nombre_encuesta' => 'Valoración Profesor' ,'estado' => 1),
            array('id_encuesta' => 6,'nombre_encuesta' => 'Carga Academica' ,'estado' => 1),
                   
         ];
        Encuesta::insert($data);
    }
}
