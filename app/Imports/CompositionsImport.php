<?php

namespace App\Imports;

use App\Composition;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class CompositionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Composition([
            'id' =>$row[0],
            'en_name'      => $row[1],
            'ar_name'      => $row[2],
            'status_id' => 1
        ]);
    }
}
