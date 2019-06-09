<?php

namespace App\Imports;

use App\Drug;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class DrugsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Drug([
            'id'             =>$row[0],
            'en_name'        =>$row[1],
            'ar_name'        =>$row[2],
            'company_id'     =>$row[3],
            'form_id'        =>$row[4],
            'amount_of_form' =>$row[5],
            'barcodes'       =>$row[6],
            'pharma_price'   =>$row[7],
            'lay_price'      =>$row[8],
            'status_id'      => 1
        ]);

    }
}
 

