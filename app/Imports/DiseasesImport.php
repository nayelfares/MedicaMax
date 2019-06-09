<?php

namespace App\Imports;

use App\Disease;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DiseasesImport implements ToModel //, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
            /*$re = '/\w|\s/um';
            preg_match_all($re, $row[5], $matches, PREG_SET_ORDER, 0);
            $s_ar_term ='';
            foreach ($matches as $matche) 
            {
                $s_ar_term=$s_ar_term.$matche[0];
            }*/
        return new Disease([
            'id' =>$row[0],
            'show_code' => $row[1] == "&&" ? 1 : 0 ,
            'parent_code' => $row[2] ,
            'code' => $row[3] ,
            'en_term'      => $row[4],
            'ar_term'  => $row[5],
        ]);
    }
  /*  
    public function chunkSize(): int
    {
        return 100;
    }
  */











   /*public function startRow(): int {
      return 2;
   }*/




}
