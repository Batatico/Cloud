<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenidoEncuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_encuesta',
        'id_pregunta',
        'pregunta',
        'indicador',
    ];
    protected $primaryKey = 'id_pregunta';

}
