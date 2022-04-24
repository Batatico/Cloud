<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asignatura;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('id' => 1,'nrc' => 100, 'codigo_asignatura' => 100, 'rut_profesor' => '130108937', 'nombre_profesor' => 'Esteban Flores', 'estado' => 1, 'periodo_academico' => 202110),
                   
         ];
        Asignatura::insert($data);     
    }
}
