<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenedor_Asignatura extends Model
{
    use HasFactory;

    protected $table = "Contenedor_Asignaturas";

    protected $fillable = [

        'rut_alumno',
        'nrc_asignatura'
    ];
}
