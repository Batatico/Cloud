<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaAsignatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nrc_asignatura',
        'id_encuesta',
    ];
}
