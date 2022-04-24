<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EncuestaAsignatura;

class EncuestaAsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('nrc_asignatura' => 	101, 'id_encuesta' => 1),
            array('nrc_asignatura' => 	102, 'id_encuesta' => 2),
            array('nrc_asignatura' => 	105, 'id_encuesta' => 3), 
            array('nrc_asignatura' => 	106, 'id_encuesta' => 4), 
            array('nrc_asignatura' => 	107, 'id_encuesta' => 5),
              
         ];
        EncuestaAsignatura::insert($data);  
    }
}
