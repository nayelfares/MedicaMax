<?php
namespace App\Imports;

use App\Dictionary;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DictionayImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Dictionary::create([
                  'arabicText'     => $row[1],
           'englishText'    => $row[2],
           'dictionary_id'     => $row[3],
           'status'    => $row[6],
           'arabicTextRaw' => $row[7],
           'englishTextRaw' => $row[8],
            ]);
        }
    }
}
/*
namespace App\Imports;

use App\Dictionary;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class DictionayImport implements ToModel
{
    
    public function model(array $row)
    {
        return new Dictionary([
            'arabicText'     => $row[1],
           'englishText'    => $row[2],
           'dictionary_id'     => $row[3],
           'status'    => $row[6],
           'arabicTextRaw' => $row[7],
           'englishTextRaw' => $row[8], 
        ]);
    }
}
*/


