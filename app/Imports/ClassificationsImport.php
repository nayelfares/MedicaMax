<?php

namespace App\Imports;

use App\Classification;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ClassificationsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        // one time from user
       /* return new Classification([
            //
            'id' =>$row[0],
            'parent_id' =>$row[1],
            'code'        => $row[2] ,
            'parent_code' => $row[3] ,
            'en_term'      => $row[4],
            'ar_term'      => $row[5],
            'classification_level' =>$row[6],
            'note'    => '',
            'status_id' => 1
        ]);*/

        //from export system
         return new Classification([
            //
            'id' =>$row[0],
            'uuid' =>$row[1],
            'code' => $row[2] ,
            'en_term'      => $row[3],
            'classification_level' =>$row[4],
            'ar_term'  => $row[5],
            'parent_id' =>$row[6],
            'parent_code' => $row[7] ,
            'status_id' => $row[8],
            'note'    => $row[9]
        ]);
    }
}
