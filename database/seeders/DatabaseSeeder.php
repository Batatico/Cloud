<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(AlumnoEncuestaSeeder::class);      
        $this->call(EncuestaSeeder::class);
        $this->call(ContenidoEncuestaSeeder::class);
        $this->call(RespuestaSeeder::class);
        $this->call(AlumnoSeeder::class);
        $this->call(AyudanteSeeder::class);
        $this->call(AsignaturaSeeder::class);
        $this->call(EncuestaAsignaturaSeeder::class);

    }
}
