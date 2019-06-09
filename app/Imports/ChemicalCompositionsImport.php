<?php

namespace App\Imports;

use App\ChemicalComposition;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ChemicalCompositionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ChemicalComposition([
            'id' =>$row[0],
            'drug_id' =>$row[1],
            'composition_id' =>$row[2],
            'composition_quantity_id' => $row[3] 
        ]);
    }
}