<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PeriodoAcademico;

class PeriodoAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('id' => 10, 'codigo_semestre' => 201910, 'descripcion' => 'Primer semestre 2019', 'estado' => 0),
            array('id' => 11, 'codigo_semestre' => 201920, 'descripcion' => 'Segundo semestre 2019', 'estado' => 0),
            array('id' => 12, 'codigo_semestre' => 202010, 'descripcion' => 'Primer semestre 2020', 'estado' => 0),
            array('id' => 13, 'codigo_semestre' => 202020, 'descripcion' => 'Segundo semestre 2020', 'estado' => 0),

        ];
        PeriodoAcademico::insert($data);    
    }
}
