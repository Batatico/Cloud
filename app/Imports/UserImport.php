<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Freshwork\ChileanBundle\Rut;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;


class UserImport implements ToModel,WithHeadingRow,SkipsOnError
{
    use SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['nombre'],
            'rut' => Rut::parse($row['rut_alumno'])->normalize(),
            'email' => $row['correo'],
            'password' => Hash::make(Rut::parse($row['rut_alumno'])->number()),
            'role' => 'estudiante',
            'estado' => true,
            

            
        ]);    
    }

    public function onError(Throwable $error)
    {
        
    }
}
