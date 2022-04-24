<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoEncuesta extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_encuesta',
        'rut_alumno',               
        'respondida',
            
    ];
    
    public $timestamps = false;

}
