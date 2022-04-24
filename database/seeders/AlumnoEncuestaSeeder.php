<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlumnoEncuesta;

class AlumnoEncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('id_encuesta' => 1,'rut_alumno' => 'q','respondida' => 1 ,),
            array('id_encuesta' => 1,'rut_alumno' => 'e','respondida' => 1 ),
            array('id_encuesta' => 2,'rut_alumno' => 's','respondida' => 0 ),
            array('id_encuesta' => 2,'rut_alumno' => 't','respondida' => 0 ),
            array('id_encuesta' => 3,'rut_alumno' => 'y','respondida' => 0 ),
            array('id_encuesta' => 3,'rut_alumno' => 'p','respondida' => 0 ),
        ];
        AlumnoEncuesta::insert($data);
    }
}
