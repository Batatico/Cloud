<?php

namespace App\Imports;

use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Freshwork\ChileanBundle\Rut;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;


class AlumnoImport implements ToModel,WithHeadingRow
{
    use SkipsErrors;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Alumno([
            'rut_alumno' => Rut::parse($row['rut_alumno'])->normalize(),
            'correo' => $row['correo'],
            'nombre' => $row['nombre'],            
            'password' => Hash::make(Rut::parse($row['rut_alumno'])->number()),
            
        ]);  
    }
   
}
