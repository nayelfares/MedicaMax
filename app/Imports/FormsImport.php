<?php

namespace App\Imports;

use App\Form;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class FormsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Form([
            'id'        => $row[0],
            'en_name'   => $row[1] ,
            'ar_name'   => $row[2] ,
            'parent_id' => $row[3],
            'form_unit' => $row[4],
            'amount'    => $row[5],
            'status_id' => 1
        ]);
    }
}
 