<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ayudante extends Model
{
    use HasFactory;

    protected $table = "ayudantes";

    protected $fillable = [

        'rut_alumno',
        'nrc_asignatura'
    ];
}
