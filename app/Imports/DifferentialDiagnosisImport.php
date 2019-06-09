<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\DifferentialDiagnosis;

class DifferentialDiagnosisImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    /*public function collection(Collection $collection)
    {
    }*/
    public function model(array $row)
    {
        return new DifferentialDiagnosis([
            'id' =>$row[0],
            'show_code' =>  0 ,
            'parent_code' => $row[1] ,
            'code' => $row[2] ,
            'en_term'      => $row[4],
            'ar_term'  => $row[5],
            's_ar_term' => "1"
        ]);
    }
}
