<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_encuesta',
        'id_pregunta',
        'respuesta',
        'rut_ayudante',
    ];
}
