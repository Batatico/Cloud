<?php

namespace App\Imports;

use App\Models\Ayudante;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Freshwork\ChileanBundle\Rut;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;
use Illuminate\Support\Facades\DB;


class AyudanteImport implements ToModel,WithHeadingRow
{
    use SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        $existe = DB::table('contenedor_asignaturas')->select('*')->where('rut_alumno',Rut::parse($row['rut_alumno'])->normalize())->where('nrc_asignatura',$row['nrc_asignatura'])->exists();
        if(!$existe)         
        {             
            DB::table('alumnos')->where('rut_alumno', Rut::parse($row['rut_alumno'])->normalize())->update(['es_ayudante' => 1 ]);             
           
            return new Ayudante([                 
                'rut_alumno' => Rut::parse($row['rut_alumno'])->normalize(),                 
                'nrc_asignatura' => $row['nrc_asignatura'],             
            ]);         
        }
        else{
            return nullValue();
        }


       
    }
    
}
