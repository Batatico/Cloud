<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ayudante;

class AyudanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('id' => 1, 'rut_alumno' => '105678894', 'nrc_asignatura' => 2031),
         ];
        Ayudante::insert($data);  
    }
}
