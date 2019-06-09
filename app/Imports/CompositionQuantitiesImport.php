<?php

namespace App\Imports;

use App\CompositionQuantity;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class CompositionQuantitiesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CompositionQuantity([
            'id' =>$row[0],
            'composition_id'      => $row[1],
            'quantity'      => $row[2]
    
        ]);
    }
}

