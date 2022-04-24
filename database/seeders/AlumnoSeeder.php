<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('id' => 100,'rut_alumno' => 1 ,'correo' => 'a','nombre' => 'k' ,'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 200,'rut_alumno' => 2 ,'correo' => 'b','nombre' => 'l'  ,'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 300,'rut_alumno' => 3 ,'correo' => 'c','nombre' => 'm'  ,'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 400,'rut_alumno' => 4 ,'correo' => 'd','nombre' => 'n'  ,'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 500,'rut_alumno' => 5 ,'correo' => 'e','nombre' => 'o'  ,'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 600,'rut_alumno' => 6 ,'correo' => 'f','nombre' => 'p'  ,'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 700,'rut_alumno' => 7 ,'correo' => 'g','nombre' => 'q'  ,'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 800,'rut_alumno' => 8 ,'correo' => 'h','nombre' => 'r'  ,'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 900,'rut_alumno' => 9 ,'correo' => 'i','nombre' => 's', 'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
            array('id' => 1000,'rut_alumno' => 10 ,'correo' => 'j','nombre' => 't', 'estado' => 1 ,'es_ayudante' => 0,'password' => 'q'),
        ];
        Alumno::insert($data);    }
    
}
