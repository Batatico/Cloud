<?php

namespace App\Imports;

use App\Models\Contenedor_Asignatura;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Freshwork\ChileanBundle\Rut;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;
use Illuminate\Support\Facades\DB;



class Contenedor_AsignaturaImport implements ToModel, WithHeadingRow
{
    use SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $existe = DB::table('contenedor_asignaturas')->where('rut_alumno',Rut::parse($row['rut_alumno'])->normalize())->where('nrc_asignatura',$row['nrc_asignatura'])->exists();
        
        if($existe == false){
            return new Contenedor_Asignatura([

                'rut_alumno' => Rut::parse($row['rut_alumno'])->normalize(),
                'nrc_asignatura' => $row['nrc_asignatura'],
            ]);
        } 
        else{
            return nullValue();
        }
        // return new Contenedor_Asignatura([
            
        //     'rut_alumno' => Rut::parse($row['rut_alumno'])->normalize(),
        //     'nrc_asignatura' => $row['nrc_asignatura'],
        // ]);
    }
   
}
