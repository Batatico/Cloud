<?php

namespace App\Imports;

use App\Models\Asignatura;
use Hamcrest\Text\IsEqualIgnoringCase;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;
use Illuminate\Support\Facades\DB;
use Freshwork\ChileanBundle\Rut;

class AsignaturaImport implements ToModel,WithHeadingRow
{
    use SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $pa = DB::table('periodo_academicos')->where('estado', 1)->first();
        $cod_semestre = $pa->codigo_semestre;   

        //revisa que haya un profesor por asignatura
        $existe = DB::table('asignaturas')->where('rut_profesor', Rut::parse($row['rut_profesor'])->normalize())->where('codigo_asignatura', $row['codigo_asignatura'])->exists();

        if($existe == false){

            return new Asignatura([
                'nrc' => $row['nrc'],
                'codigo_asignatura' => $row['codigo_asignatura'],
                'rut_profesor' => Rut::parse($row['rut_profesor'])->normalize(),
                'nombre_profesor' => $row['nombre_profesor'],
                'periodo_academico' => $cod_semestre,
            ]);
        }
        else{
            return nullValue();
        }
              
    }

    
   
}
