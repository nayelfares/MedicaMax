<?php

namespace App\Imports;

use App\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class CompaniesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            return new Company([
            'id'         => $row[0],
            'en_name'    => $row[1] ,
            'ar_name'    => $row[2] ,
            'en_article' => $row[3],
            'ar_article' => $row[4],
            'location'   => $row[5],
            'status_id'  => 1
        ]);
    }
}
